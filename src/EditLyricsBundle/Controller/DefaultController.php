<?php

namespace EditLyricsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EditLyrics/Default/index.html.twig');
    }
    
    private function maximLinesAmount()
    {
        
    }
    
    public function getLyricAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $video_id = $_POST['current_video_id'];
            $lyricsline_MaxValue = 0;
            
            // hay que contar la cantidad maxima de palabras para poder obtener cuál es el maximo valor 
            // INGRESADO ($lyricsline_MaxValue) por el usuario respecto a las estrofas que hay en la canción
            // 
            //////////////////////////////////////////////////////////////////////////////////////////////
            // COUNT THE TOTAL AMOUNT OF WORDS REGERDLES OF THE LINE WHERE THERE ARE STORE...
            // FOR EXAMPLE IF THE VIDEO CONTAINS 300 WORDS, 
            // SO THIS FUNCTION WOULD SHOW US THE NUMBER 300 AS THE TOTAL AMOUNT OF WORDS: ($totalAmountKeywords++;)
            $word = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent, 
                ll.lyricslineId, ll.lyricslinePosition, 
                lw.lyricswordId, lw.lyricswordStarttime, lw.lyricswordEndtime 
                FROM HomeBundle:Keyword k 
                JOIN HomeBundle:Lyricsword lw 
                WITH k.keywordId = lw.keyword 
                JOIN HomeBundle:Lyricsline ll
                WITH ll.lyricslineId = lw.lyricsline 
                JOIN HomeBundle:Video v 
                WITH v.videoId = ll.video 
                WHERE v.videoId = '$video_id'"
            );
            $word_e = $word->getResult(); // array que me clasifica o/y almacena TODAS las palabras de la letra de la canción del video

            $totalAmountKeywords = 0;
            while (isset($word_e[$totalAmountKeywords]['keywordId'])) {
                
                $thisWordPosition = $totalAmountKeywords;
                $nextWordPosition = $totalAmountKeywords + 1;
                
                // extraer la maxima cantidad de estrofas que se encuentre en: $lyricslinePosition_Value
                // y crear el array teniendo como referente ese valor en un for: $lyricsline_MaxValue
                
                if (isset($word_e[$nextWordPosition]['keywordId']))
                {
                    $thisLyricsLine = $word_e[$thisWordPosition]['lyricslinePosition'];
                    $nextLyricsLine = $word_e[$nextWordPosition]['lyricslinePosition'];
                    
                    if ($lyricsline_MaxValue < $nextLyricsLine)
                    {
                        $lyricsline_MaxValue = $nextLyricsLine;
                    }
                    else if ($lyricsline_MaxValue < $thisLyricsLine)
                    {
                        $lyricsline_MaxValue = $thisLyricsLine;
                    }
                } else 
                {
                    $nextWordPosition = $thisWordPosition;
                }
                $totalAmountKeywords++;
            }
            
            // ESTE WHILE RECORRE UNA POR UNA CADA UNA DE LAS RESPECTIVAS LINEAS
            // PARA EVALUAR LAS PALABRAS QUE ESTEN CONTENIDAS EN CADA UNA DE LAS RESPECTIVAS LÍNEAS
            $estrofa = 0;
            while ($estrofa <= $lyricsline_MaxValue+1) // $lyricsline_MaxValue
            {
                $word_per_line = $em->createQuery(
                    "SELECT k.keywordId, k.keywordContent, 
                    ll.lyricslineId, ll.lyricslinePosition, 
                    lw.lyricswordId, lw.lyricswordStarttime, lw.lyricswordEndtime 
                    FROM HomeBundle:Keyword k 
                    JOIN HomeBundle:Lyricsword lw 
                    WITH k.keywordId = lw.keyword 
                    JOIN HomeBundle:Lyricsline ll
                    WITH ll.lyricslineId = lw.lyricsline 
                    JOIN HomeBundle:Video v 
                    WITH v.videoId = ll.video 
                    WHERE ll.lyricslinePosition = '$estrofa' and v.videoId = '$video_id' ORDER BY lw.lyricswordStarttime ASC"
                );
                $word_per_line_e = $word_per_line->getResult();
                
                
                //////////////////////////////////////////////////////////////////////////////////////////////
                // HACER WHILE POR LA CANTIDAD MAXIMA DE PALABRAS QUE SE ENCUENTRE EN LA RESPECTIVA ESTROFA
                $wordsPerLyricsline_MaxValue = 0;
                while (isset($word_per_line_e[$wordsPerLyricsline_MaxValue]['keywordId']))
                {
                    $wordsPerLyricsline_MaxValue++;    
                }
                
                $palabra = 0;
                while ($palabra <= $wordsPerLyricsline_MaxValue+1)
                {
                    if (isset($word_per_line_e[$palabra]['keywordId'])){
                        $keywordId_Value = $word_per_line_e[$palabra]['keywordId'];
                        $keywordContent_Value = $word_per_line_e[$palabra]['keywordContent'];
                        $lyricslineId_Value = $word_per_line_e[$palabra]['lyricslineId'];
                        $lyricslinePosition_Value = $word_per_line_e[$palabra]['lyricslinePosition'];
                        $lyricswordId_Value = $word_per_line_e[$palabra]['lyricswordId'];
                        $lyricswordStarttime_Value = $word_per_line_e[$palabra]['lyricswordStarttime'];
                        $lyricswordEndtime_Value = $word_per_line_e[$palabra]['lyricswordEndtime'];

                        $lyric_word[$estrofa][$palabra] = array(
                            'keywordId' => $keywordId_Value, 
                            'keywordContent' => $keywordContent_Value, 
                            'lyricslineId' => $lyricslineId_Value, 
                            'lyricslinePosition' => $lyricslinePosition_Value, 
                            'lyricswordId' => $lyricswordId_Value, 
                            'lyricswordStarttime' => $lyricswordStarttime_Value, 
                            'lyricswordEndtime' => $lyricswordEndtime_Value, 
                            'palabra' => $palabra, // 0, 1, 2, 3, 4, 5
                            'estrofa' => $estrofa, // 0, 1, 2, 3
                            'lyricsline_MaxValue' => $lyricsline_MaxValue, // nunca cambiará este valor
                            'wordsPerLyricsline_MaxValue' => $wordsPerLyricsline_MaxValue // cambiará de acuerdo a la fila en que se encuentre
                        );
                    } else {
                        $lyric_word[$estrofa][$palabra] = array(
                            'keywordId' => 0, 
                            'keywordContent' => "", 
                            'lyricslineId' => 0, 
                            'lyricslinePosition' => 0, 
                            'lyricswordId' => 0, 
                            'lyricswordStarttime' => "null", 
                            'lyricswordEndtime' => "null", 
                            'palabra' => $palabra, // 0, 1, 2, 3, 4, 5
                            'estrofa' => $estrofa, // 0, 1, 2, 3
                            'lyricsline_MaxValue' => $lyricsline_MaxValue, 
                            'wordsPerLyricsline_MaxValue' => 0
                        );
                    }
                    $palabra++;
                }
                $estrofa++;
            }
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            if ( $totalAmountKeywords === 0 )
            {
//                // NO HAY NI UNA SOLA PALABRA
                $lyric_word[0][0] = array(
                    'keywordId' => 0, 
                    'keywordContent' => "", 
                    'lyricslineId' => 0, 
                    'lyricslinePosition' => 0, 
                    'lyricswordId' => 0, 
                    'lyricswordStarttime' => 0, 
                    'lyricswordEndtime' => 0, 
                    'palabra' => 0, // 0, 1, 2, 3, 4, 5
                    'estrofa' => 0, // 0, 1, 2, 3
                    'lyricsline_MaxValue' => $lyricsline_MaxValue, 
                    'wordsPerLyricsline_MaxValue' => 0
                );
            }
            
            return new Response(json_encode($lyric_word), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function deleteLyricsWordAction(Request $request)
    {
        $current_video_id = $_POST['current_video_id'];
        $lyricsWord = $_POST['lyricsWord'];
        $lyricsLine = $_POST['lyricsLine'];
        $lyricsWordId = $_POST['lyricsWordId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $lyricsword = $em->getRepository('HomeBundle:Lyricsword')->findOneByLyricswordId($lyricsWordId);
            $em->remove($lyricsword);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona123...456"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function saveLyricsWordAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();

            $current_video_id = $_POST['current_video_id'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $lyricsWordContent = $_POST['lyricsWord'];
            $lyricslinePosition = $_POST['lyricsLine'];
            
            $lyricsWordContent_depurate = $this->purgeKeywords($lyricsWordContent); // me elimina exceso de espacios en blanco en caso de que hayan
            
            $keywordId = $this->setKeyword($em, $lyricsWordContent_depurate);
            $keywordvideoId = $this->setKeywordVideo($em, $current_video_id, $keywordId); // para posicionar el video con el karaoke
            $lyricsLineId = $this->setLyricsLine($em, $current_video_id, $lyricslinePosition);
            $lyricswordId = $this->setLyricsWord($em, $current_video_id, $startTime, $endTime, $lyricsWordContent_depurate, $lyricslinePosition);
            
            $users2 = array();
            $users2[0] = array(
                'lyricswordId' => $lyricswordId, 
                'lyricswordStarttime' => $startTime, 
                'lyricswordEndtime' => $endTime, 
                'keywordContent' => $lyricsWordContent_depurate, 
                'lyricslinePosition' => $lyricslinePosition
            );
            
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    public function purgeKeywords($lyricsWordContent)
    {
        $word_entered = array(); // array que me almacena la cantidad de palabras
        if ($lyricsWordContent) {
            $characters_entered_amount = 0;
            $temporal_word = "";

            // separar palabras de la frase que se ingresó en el motor de busqueda
            for ($i = 0; $i < strlen($lyricsWordContent); $i++) {
                //si llegase a existir un espacio entre la frase que se escribió en el buscador,
                //entonces que me ejecute lo siguiente:
                if ($lyricsWordContent[$i] == " ") {
                    $temporal_word = "";
                    $previous = $i - 1;

                    //si el caracter actual y el caracter anterior son espacios en blanco
                    if ($lyricsWordContent[$previous] == " ") {

                    } else {
                        //si el caracter actual es espacio en blanco,
                        //pero el caracter anterior NO es espacio en blanco
                        $characters_entered_amount++; // creo que esto es pa contar la cantidad de palabras
                    }
                } else {
                    $temporal_character = $lyricsWordContent[$i];
                    $temporal_word .= $temporal_character;
                    $word_entered[$characters_entered_amount] = $temporal_word;
                }
            }
        }
        
        $lyricsWordContent_depurate = "";
        for ($i = 0; $i <= $characters_entered_amount; $i++)
        {
            $lyricsWordContent_depurate.=$word_entered[$i]." ";
        }
        return $lyricsWordContent_depurate;
    }

    
    
    
    
    
    public function setKeyword($em, $lyricsWordContent)
    {
        $keyword = $em->createQuery(
            "SELECT k.keywordId 
            FROM HomeBundle:Keyword k 
            WHERE k.keywordContent = '$lyricsWordContent'"
        );
        $keyword_e = $keyword->getResult();

        if (isset($keyword_e[0]['keywordId'])) {
            // NO insertar la palabra ya que se encuntra en la bd
            $keywordId = $keyword_e[0]['keywordId'];
            return $keywordId;
        } else
        {
            // insertar la palabra ya que NO se encuntra en la bd
            $keywordEntity = new \HomeBundle\Entity\Keyword();
            $keywordEntity->setKeywordContent($lyricsWordContent);
            $keywordEntity->setKeywordScore(0);
            $em->persist($keywordEntity);
            $em->flush();
            $keywordId = $keywordEntity->getKeywordId();
            return $keywordId;
        }
    }
    
    public function setKeywordVideo($em, $current_video_id, $keywordId)
    {
        $video_value = $em->getRepository('HomeBundle:Video')->findOneByVideoId($current_video_id);
        $keyword_value = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId);
        
        $keywordvideo = $em->createQuery(
            "SELECT kv.keywordvideoId 
            FROM HomeBundle:Keywordvideo kv 
            
            JOIN HomeBundle:Video v 
            WITH v.videoId = kv.video 
            
            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = kv.keyword 
            
            WHERE v.videoId = '$current_video_id' and k.keywordId = '$keywordId'"
        );
        $keywordvideo_e = $keywordvideo->getResult();

        if (isset($keywordvideo_e[0]['keywordvideoId'])) {
            // NO insertar la palabra ya que se encuntra en la bd
            $keywordvideoId = $keywordvideo_e[0]['keywordvideoId'];
            
            return $keywordvideoId;
        } else
        {
            // insertar la palabra ya que NO se encuntra en la bd
            $keywordvideoEntity = new \HomeBundle\Entity\Keywordvideo();
            $keywordvideoEntity->setKeyword($keyword_value);
            $keywordvideoEntity->setVideo($video_value);
            $em->persist($keywordvideoEntity);
            $em->flush();
            
            $keywordvideoId = $keywordvideoEntity->getKeywordvideoId();
            
            return $keywordvideoId;
        }
    }
    
    public function setLyricsLine($em, $current_video_id, $lyricslinePosition)
    {
        $video_value = $em->getRepository('HomeBundle:Video')->findOneByVideoId($current_video_id);

        $lyricsLine = $em->createQuery(
            "SELECT ll.lyricslineId, ll.lyricslinePosition, v.videoId 
            FROM HomeBundle:Lyricsline ll 
            JOIN HomeBundle:Video v 
            WITH ll.video = v.videoId 
            WHERE ll.lyricslinePosition = '$lyricslinePosition' and v.videoId = '$current_video_id'"
        );
        $lyricsLine_e = $lyricsLine->getResult();

        if (isset($lyricsLine_e[0]['lyricslineId'])) {
            // NO insertar la linea (estrofa), ya que se encuentra en la BD 
            $lyricsLineId = $lyricsLine_e[0]['lyricslineId'];
            
            return $lyricsLineId;
        } else
        {
            // insertar la línea (estrofa), ya que NO se encuentra en la BD
            $LyricslineEntity = new \HomeBundle\Entity\Lyricsline();
            $LyricslineEntity->setLyricslinePosition($lyricslinePosition);
            $LyricslineEntity->setVideo($video_value);
            $em->persist($LyricslineEntity);
            $em->flush();
            $lyricsLineId = $LyricslineEntity->getLyricslineId();
            $lyricslinePosition = $LyricslineEntity->getLyricslinePosition();
            
            return $lyricsLineId;
        }

    }
    
    public function setLyricsWord($em, $current_video_id, $startTime, $endTime, $lyricsWordContent, $lyricslinePosition)
    {
        $keywordId = $this->setKeyword($em, $lyricsWordContent);
        $lyricsLineId = $this->setLyricsLine($em, $current_video_id, $lyricslinePosition);

        $keywordEntity_value = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId);
        $lyricsLineEntity_value = $em->getRepository('HomeBundle:Lyricsline')->findOneByLyricslineId($lyricsLineId);
        
        $lyricsWord = $em->createQuery(
            "SELECT lw.lyricswordId, lw.lyricswordStarttime, lw.lyricswordEndtime, 
                ll.lyricslineId, 
                k.keywordId 
            FROM HomeBundle:Lyricsword lw 
            
            JOIN HomeBundle:Lyricsline ll 
            WITH ll.lyricslineId = lw.lyricsline 
            
            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = lw.keyword 
            
            
            WHERE k.keywordContent = '$lyricsWordContent' and 
            lw.lyricswordStarttime = '$startTime' and 
            lw.lyricswordEndtime = '$endTime' and 
            ll.lyricslinePosition = '$lyricslinePosition'
            "
        );
        $lyricsWord_e = $lyricsWord->getResult();

        if (isset($lyricsWord_e[0]['lyricswordId'])) {
            // NO insertar la linea (estrofa), ya que se encuentra en la BD 
            $lyricswordId = $lyricsWord_e[0]['lyricswordId'];
            
            return $lyricswordId;
        } else
        {
            // insertar la línea (estrofa), ya que NO se encuentra en la BD
            $LyricswordEntity = new \HomeBundle\Entity\Lyricsword();
            $LyricswordEntity->setKeyword($keywordEntity_value);
            $LyricswordEntity->setLyricsline($lyricsLineEntity_value);
            $LyricswordEntity->setLyricswordStarttime($startTime);
            $LyricswordEntity->setLyricswordEndtime($endTime);
            $em->persist($LyricswordEntity);
            $em->flush();
            
            $lyricswordId = $LyricswordEntity->getLyricswordId();
            return $lyricswordId;
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function editLyricsWordAction(Request $request)
    {
        $current_video_id = $_POST['current_video_id'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $lyricsWordId = $_POST['lyricsWordId'];
        $lyricsWordContent = $_POST['lyricsWord'];
        $lyricslinePosition = $_POST['lyricsLine'];
            
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            ////////////////////////////////////////////////////////////
            
            $video_value = $em->getRepository('HomeBundle:Video')->findOneByVideoId($current_video_id);
            
            $keyword = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent 
                FROM HomeBundle:Keyword k 
                WHERE k.keywordContent = '$lyricsWordContent'"
            );
            $keyword_e = $keyword->getResult();
            
            if (isset($keyword_e[0]['keywordContent'])) {
                // NO insertar la palabra ya que se encuntra en la bd
                $keywordId = $keyword_e[0]['keywordId'];
                $keywordContent = $keyword_e[0]['keywordContent'];
            } else
            {
                // insertar la palabra ya que NO se encuntra en la bd
                $keywordEntity = new \HomeBundle\Entity\Keyword();
                $keywordEntity->setKeywordContent($lyricsWordContent);
                $em->persist($keywordEntity);
                $em->flush();
                $keywordId = $keywordEntity->getKeywordId();
                $keywordContent = $keywordEntity->getKeywordContent();
            }
            
            ////////////////////////////////////////////////////////////
            
            $lyricsLine = $em->createQuery(
                "SELECT ll.lyricslineId, ll.lyricslinePosition, v.videoId 
                FROM HomeBundle:Lyricsline ll 
                JOIN HomeBundle:Video v 
                WITH ll.video = v.videoId 
                WHERE ll.lyricslinePosition = '$lyricslinePosition' and v.videoId = '$current_video_id'"
            );
            $lyricsLine_e = $lyricsLine->getResult();
            
            if (isset($lyricsLine_e[0]['lyricslineId'])) {
                // No insertar la linea (estrofa), ya que se encuentra en la BD 
                $lyricsLineId = $lyricsLine_e[0]['lyricslineId'];
            } else
            {
                // insertar la línea (estrofa), ya que se encuentra en la BD
                $LyricslineEntity = new \HomeBundle\Entity\Lyricsline();
                $LyricslineEntity->setLyricslinePosition($lyricslinePosition);
                $LyricslineEntity->setVideo($video_value);
                $em->persist($LyricslineEntity);
                $em->flush();
                $lyricsLineId = $LyricslineEntity->getLyricslineId();
                $lyricslinePosition = $LyricslineEntity->getLyricslinePosition();
            }
            
            ////////////////////////////////////////////////////////////
            
            $keywordEntity_values = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId);
            $lyricsLineEntity_values = $em->getRepository('HomeBundle:Lyricsline')->findOneByLyricslineId($lyricsLineId);
            
            $lyricsWord = $em->createQuery(
                "SELECT lw.lyricswordId, ll.lyricslineId, k.keywordId 
                FROM HomeBundle:Lyricsword lw 
                JOIN HomeBundle:Lyricsline ll 
                WITH lw.lyricsline = ll.lyricslineId 
                JOIN HomeBundle:Keyword k 
                WITH lw.keyword = k.keywordId 
                WHERE lw.lyricswordId = '$lyricsWordId'"
            );
            
            $lyricsWord_e = $lyricsWord->getResult();
            
            if (isset($lyricsWord_e[0]['lyricswordId'])) {
                // modificar 'lyricsWord', pues se encuentra en la BD 
                $lyricswordId = $lyricsWord_e[0]['lyricswordId'];
                $LyricswordEntity = $em->getRepository('HomeBundle:Lyricsword')->findOneByLyricswordId($lyricswordId);
                $LyricswordEntity->setKeyword($keywordEntity_values);
                $LyricswordEntity->setLyricsline($lyricsLineEntity_values);
                $LyricswordEntity->setLyricswordStarttime($startTime);
                $LyricswordEntity->setLyricswordEndtime($endTime);
                $em->persist($LyricswordEntity);
                $em->flush();
            } else
            {
                // insertar la "palabra de la letra de la canción" (lyricsWord)
                $LyricswordEntity = new \HomeBundle\Entity\Lyricsword();
                $LyricswordEntity->setKeyword($keywordEntity_values);
                $LyricswordEntity->setLyricsline($lyricsLineEntity_values);
                $LyricswordEntity->setLyricswordStarttime($startTime);
                $LyricswordEntity->setLyricswordEndtime($endTime);
                $em->persist($LyricswordEntity);
                $em->flush();
            }
            
            ////////////////////////////////////////////////////////////
            
            $users2 = array();
            $users2[0] = array(
                'current_video_id' => $current_video_id,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'lyricsWord' => $lyricsWordContent,
                'lyricsWordId' => $lyricsWordId,
                'lyricslinePosition' => $lyricslinePosition
            );
            
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getLyricsFrameAction(Request $request)
    {
        $current_video_id = $_POST['current_video_id'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
    
            $lyricsWord = $em->createQuery(
                "SELECT k.keywordContent, ll.lyricslinePosition, lw.lyricswordId, lw.lyricswordStarttime, lw.lyricswordEndtime 
                FROM HomeBundle:Keyword k 
                JOIN HomeBundle:Lyricsword lw 
                WITH k.keywordId = lw.keyword 
                JOIN HomeBundle:Lyricsline ll 
                WITH lw.lyricsline = ll.lyricslineId 
                JOIN HomeBundle:Video v 
                WITH v.videoId = ll.video
                WHERE v.videoId = '$current_video_id'"
            );

            $lyricsWord_e = $lyricsWord->getResult();
            
            $amountLyricsWord = 0;
            while (isset($lyricsWord_e[$amountLyricsWord]['keywordContent'])) {
                $amountLyricsWord++;
            }
            
            $i = 0;
            while (isset($lyricsWord_e[$i]['keywordContent'])) {

                if ($lyricsWord_e) {
                    $keywordContent_Value = $lyricsWord_e[$i]['keywordContent'];
                    $lyricslinePosition_Value = $lyricsWord_e[$i]['lyricslinePosition'];
                    $lyricswordId_Value = $lyricsWord_e[$i]['lyricswordId'];
                    $lyricswordStarttime_Value = $lyricsWord_e[$i]['lyricswordStarttime'];
                    $lyricswordEndtime_Value = $lyricsWord_e[$i]['lyricswordEndtime'];
                    $amountLyricsWord_Value = $amountLyricsWord;
                } else {
                    $keywordContent_Value = "_";
                    $lyricslinePosition_Value = "_";
                    $lyricswordId_Value = "_";
                    $lyricswordStarttime_Value = "_";
                    $lyricswordEndtime_Value = "_";
                    $amountLyricsWord_Value = $amountLyricsWord;
                }

                $lyricsWord_data[$i] = array(                    
                    'keywordContent' => $keywordContent_Value, 
                    'lyricslinePosition' => $lyricslinePosition_Value, 
                    'lyricswordId' => $lyricswordId_Value, 
                    'lyricswordStarttime' => $lyricswordStarttime_Value, 
                    'lyricswordEndtime' => $lyricswordEndtime_Value, 
                    'amountLyricsWord' => $amountLyricsWord_Value
                );
                $i++;
            }
            
            if ($i === 0)
            {
                $lyricsWord_data[$i] = array(
                    'keywordContent' => "_", 
                    'lyricslinePosition' => "_", 
                    'lyricswordId' => "_", 
                    'lyricswordStarttime' => "_", 
                    'lyricswordEndtime' => "_", 
                    'amountLyricsWord' => 0
                );                
            }
            
            return new Response(json_encode($lyricsWord_data), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}
