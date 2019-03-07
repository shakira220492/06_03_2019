<?php

namespace ShowLyricsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ShowLyrics/Default/index.html.twig');
    }
    
    public function getVideoLyricAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $video_id = $_POST['current_video_id'];
            $lyricsline_MaxValue = 0;
            $palabras = 0;
            
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
                            'wordsPerLyricsline_MaxValue' => $wordsPerLyricsline_MaxValue, // cambiará de acuerdo a la fila en que se encuentre
                            'palabras' => $palabras
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
                            'wordsPerLyricsline_MaxValue' => 0, 
                            'palabras' => $palabras
                        );
                    }
                    $palabras++;
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
                    'wordsPerLyricsline_MaxValue' => 0,
                    'palabras' => 0
                );
            }
            
            return new Response(json_encode($lyric_word), 200, array('Content-Type' => 'application/json'));
        }
    }
}