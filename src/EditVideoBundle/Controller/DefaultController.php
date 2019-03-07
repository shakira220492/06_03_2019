<?php

namespace EditVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EditVideo/Default/index.html.twig');
    }
    
    public function editVideoPropertiesAction(Request $request)
    {
        $videoId_editVideoProperties = $_POST['videoId_editVideoProperties'];
        $videoName_editVideoProperties = $_POST['videoName_editVideoProperties'];
        $videoDescription_editVideoProperties = $_POST['videoDescription_editVideoProperties'];
        $portrait_editVideoProperties = $_FILES['portrait_editVideoProperties']['name'];
        
        $em = $this->getDoctrine()->getManager();
        
        if ($request->isXMLHttpRequest()) {
            
            
            if ($portrait_editVideoProperties)
            {
                // SE MODIFICA LO SIGUIENTE: VIDEO_NAME, VIDEO_DESCRIPTION, VIDEO_IMAGE:

                // edit data
                $em = $this->getDoctrine()->getManager();
                $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId_editVideoProperties);
                $video->setVideoName($videoName_editVideoProperties);
                $video->setVideoDescription($videoDescription_editVideoProperties);
                $video->setVideoImage($portrait_editVideoProperties);
                $em->persist($video);
                $em->flush();

                // upload content
                $carpeta = "files/";
                opendir($carpeta);
                $filenameImage = $_FILES['portrait_editVideoProperties']['tmp_name'];
                $destinationImage = $carpeta . $_FILES['portrait_editVideoProperties']['name'];
                $typeImage = $_FILES['portrait_editVideoProperties']['type'];
                if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
                    move_uploaded_file($filenameImage, $destinationImage);
                } else {
                    // $product_image = "xxx";
                    // ejecutar una acción que le diga al usuario que no se pudo subir la imagen
                }
            } else
            {
                // SE MODIFICA LO SIGUIENTE: VIDEO_NAME, VIDEO_DESCRIPTION, VIDEO_IMAGE:
                
                // edit data
                $em = $this->getDoctrine()->getManager();
                $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId_editVideoProperties);
                $video->setVideoName($videoName_editVideoProperties);
                $video->setVideoDescription($videoDescription_editVideoProperties);
                $em->persist($video);
                $em->flush();
            }
            
            

            
            $videoId_value = $video->getVideoId();
            $videoName_value = $video->getVideoName();
            $videoDescription_value = $video->getVideoDescription();
            $videoImage_value = $video->getVideoImage();
            $videoContent_value = $video->getVideoContent();
            $videoUpdatedate_value = $video->getVideoUpdatedate();
            $videoAmountViews_value = $video->getVideoAmountViews();
            $videoAmountComments_value = $video->getVideoAmountComments();
            $videoLikes_value = $video->getVideoLikes();
            $videoDislikes_value = $video->getVideoDislikes();
            $user_value = $video->getUser();
            
            $videoUpdatedateString = $videoUpdatedate_value->format('d-M-Y');

            $videoAmountViewsFormat = number_format($videoAmountViews_value);

            $videoAmountCommentsFormat = number_format($videoAmountComments_value);
            
            $response = array();
            $response[] = array(
                'videoId' => $videoId_value,
                'videoName' => $videoName_value,
                'videoDescription' => $videoDescription_value,
                'videoImage' => $videoImage_value,
                'videoContent' => $videoContent_value,
                'videoUpdatedate' => $videoUpdatedateString,
                'videoAmountViews' => $videoAmountViewsFormat,
                'videoAmountComments' => $videoAmountCommentsFormat,
                'videoLikes' => $videoLikes_value,
                'videoDislikes' => $videoDislikes_value,
                'user' => $user_value
            );
            return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getVideoKeywordsAction(Request $request)
    {
        $video_Id = $_POST['video_Id'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $keyword = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent 
                FROM HomeBundle:Keyword k 
                JOIN HomeBundle:Keywordvideo kv 
                WITH kv.keyword = k.keywordId 
                JOIN HomeBundle:Video v 
                WITH kv.video = v.videoId 
                WHERE v.videoId = '$video_Id'
                "
            );
            
            $keyword_e = $keyword->getResult();
            
            $amountKeywords = 0;
            while (isset($keyword_e[$amountKeywords]['keywordId'])) {
                $amountKeywords++;
            }
            
            $i = 0;
            while (isset($keyword_e[$i]['keywordId'])) {

                if ($keyword_e) {
                    $keywordId_Value = $keyword_e[$i]['keywordId'];
                    $keywordContent_Value = $keyword_e[$i]['keywordContent'];
                } else {
                    $keywordId_Value = "_";
                    $keywordContent_Value = "_";
                }

                $sendData[$i] = array(
                    'keywordId' => $keywordId_Value,
                    'keywordContent' => $keywordContent_Value,
                    'amountKeywords' => $amountKeywords
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $sendData[0] = array(
                    'keywordId' => "_",
                    'keywordContent' => "_",
                    'amountKeywords' => 0
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function deleteVideoKeywordsAction(Request $request)
    {
        $keywordId = $_POST['keywordId'];
        $videoId = $_POST['videoId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $keywordVideo = $em->createQuery(
                "SELECT kv.keywordvideoId 
                FROM HomeBundle:Keywordvideo kv 
                JOIN HomeBundle:Keyword k 
                WITH kv.keyword = k.keywordId 
                JOIN HomeBundle:Video v 
                WITH kv.video = v.videoId 
                WHERE v.videoId = '$videoId' and k.keywordId = '$keywordId'
                "
            );
            $keywordVideo_e = $keywordVideo->getResult();
            $keywordvideoId_Value = $keywordVideo_e[0]['keywordvideoId'];
            
            $KeywordvideoToDelete = $em->getRepository('HomeBundle:Keywordvideo')->findOneByKeywordvideoId($keywordvideoId_Value);
            $em->remove($KeywordvideoToDelete);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function saveVideoKeywordsAction(Request $request)
    {
        $keywords_entered_2 = $_POST['newKeywordToTheVideo'];
        $videoId = $_POST['videoId'];

        if ($keywords_entered_2)
        {
            $em = $this->getDoctrine()->getManager();

            // me retira (espacios en blanco, saltos de linea, etc) que haya al inicio de la variable $keywords_entered
            $keywords_entered_1 = ltrim($keywords_entered_2);

            // me retira (espacios en blanco, saltos de linea, etc) que haya al final de la variable $keywords_entered
            $keywords_entered = rtrim($keywords_entered_1);



            $characters_entered_amount = $this->getCharactersEnteredAmount($keywords_entered);

            $word_entered = array();
            $word_entered = $this->separateKeywords($keywords_entered);

            $keywordProperties = $this->set_keyword($em, $characters_entered_amount, $word_entered);
            $this->set_keywordVideo($em, $characters_entered_amount, $word_entered, $videoId);

            $keywordId = $keywordProperties[0];
            $keywordContent = $keywordProperties[1];
            
        } else
        {
            $keywordId = "null";
            $keywordContent = "null";
        }
        
        if ($request->isXMLHttpRequest()) {

            $response = array();
            $response[] = array(
                'variable' => "_",
                'keywordId' => $keywordId,
                'keywordContent' => $keywordContent
            );
            return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    
    public function getCharactersEnteredAmount($keywords_entered)
    {
        $characters_entered_amount = 0;
        if ($keywords_entered) {
            for ($i = 0; $i < strlen($keywords_entered); $i++) {
                if ($keywords_entered[$i] == " ") {
                    $previous = $i - 1;

                    if ($keywords_entered[$previous] == " ") {

                    } else {
                        $characters_entered_amount++; // creo que esto es pa contar la cantidad de palabras
                    }
                } else {
                }
            }
        }
        return $characters_entered_amount;
    }
    
    public function separateKeywords($keywords_entered)
    {
        $word_entered = array(); // array que me almacena la cantidad de palabras
        if ($keywords_entered) {
            $characters_entered_amount = 0;
            $temporal_word = "";

            // separar palabras de la frase que se ingresó en el motor de busqueda
            for ($i = 0; $i < strlen($keywords_entered); $i++) {
                //si llegase a existir un espacio entre la frase que se escribió en el buscador,
                //entonces que me ejecute lo siguiente:
                if ($keywords_entered[$i] == " ") {
                    $temporal_word = "";
                    $previous = $i - 1;

                    //si el caracter actual y el caracter anterior son espacios en blanco
                    if ($keywords_entered[$previous] == " ") {

                    } else {
                        //si el caracter actual es espacio en blanco,
                        //pero el caracter anterior NO es espacio en blanco
                        $characters_entered_amount++; // creo que esto es pa contar la cantidad de palabras
                    }
                } else {
                    $temporal_character = $keywords_entered[$i];
                    $temporal_word .= $temporal_character;
                    $word_entered[$characters_entered_amount] = $temporal_word;
                }
            }

        }
        return $word_entered;
    }
    
    
    
    
    public function set_keyword($em, $characters_entered_amount, $word_entered)
    {
        $keywordContent = "";
        for ($i = 0; $i <= $characters_entered_amount; $i++)
        {
            $keywordContent.=$word_entered[$i]." ";
        }
        
        $currentKeyword = $em->createQuery(
            "SELECT k.keywordId, k.keywordScore 
            FROM HomeBundle:Keyword k 
            WHERE k.keywordContent = '$keywordContent'"
        );
        
        $currentKeyword_e = $currentKeyword->getResult();
        
        if (isset($currentKeyword_e[0]['keywordId'])) {
            $keywordId = $currentKeyword_e[0]['keywordId'];
            $keywordScore = $currentKeyword_e[0]['keywordScore'];
            
            $this->incrementar_keyword_score($em, $keywordId, $keywordScore);
            
            $keywordProperties[0] = $keywordId;
            $keywordProperties[1] = $keywordContent;
                    
            return $keywordProperties;
        } else
        {
            $keywordProperties = $this->insertar_keyword($em, $keywordContent);
                    
            return $keywordProperties;
        }
    }
                   
    public function incrementar_keyword_score($em, $keywordId, $keywordScore)
    {
        $new_keywordScore = $keywordScore + 1;
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId);
        $keyword->setKeywordScore($new_keywordScore);
        $em->persist($keyword);
        $em->flush();
    }

    public function insertar_keyword($em, $keywordContent)
    {
        $keyword = new \HomeBundle\Entity\Keyword;
        $keyword->setKeywordContent($keywordContent);
        $keyword->setKeywordScore(0);
        $em->persist($keyword);
        $em->flush();
        
        $keywordId = $keyword->getKeywordId();

        $keywordProperties[0] = $keywordId;
        $keywordProperties[1] = $keywordContent;
        
        return $keywordProperties;
        
    }
    

    
    
    public function set_keywordVideo($em, $characters_entered_amount, $word_entered, $videoId)
    {
        $keywordContent = "";
        for ($i = 0; $i <= $characters_entered_amount; $i++)
        {
            $keywordContent.=$word_entered[$i]." ";
        }
        
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($keywordContent);
        $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId);
        
        $keywordVideo = new \HomeBundle\Entity\Keywordvideo;
        $keywordVideo->setKeyword($keyword);
        $keywordVideo->setVideo($video);
        $em->persist($keywordVideo);
        $em->flush();
    }

}
