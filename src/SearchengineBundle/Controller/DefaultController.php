<?php

namespace SearchengineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('@Searchengine/Default/index.html.twig');
    }

    public function searchKeywordAction(Request $request) {

        $keywords_entered_2 = $_POST["keyword"];

        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            // me retira (espacios en blanco, saltos de linea, etc) que haya al inicio de la variable $keywords_entered
            $keywords_entered_1 = ltrim($keywords_entered_2);

            // me retira (espacios en blanco, saltos de linea, etc) que haya al final de la variable $keywords_entered
            $keywords_entered = rtrim($keywords_entered_1);

            if ($keywords_entered) {
                $characters_entered_amount = 0;
                $word_entered = array();
                $temporal_word = "";

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

                // la consulta se hace de esta manera porque la cantidad de keywords varia
                // user

                $consulta_2 = "SELECT DISTINCT v.videoId, v.videoName, v.videoDescription, v.videoImage, ";
                $consulta_2 .= "v.videoContent, v.videoUpdatedate, v.videoAmountViews, ";
                $consulta_2 .= "v.videoAmountComments, v.videoLikes, v.videoDislikes, u.userId, u.userName ";
                $consulta_2 .= "FROM HomeBundle:Video v ";
                $consulta_2 .= "JOIN HomeBundle:Keywordvideo kv ";
                $consulta_2 .= "WITH v.videoId = kv.video ";
                $consulta_2 .= "JOIN HomeBundle:User u ";
                $consulta_2 .= "WITH u.userId = v.user ";
                $consulta_2 .= "JOIN HomeBundle:Keyword k ";
                $consulta_2 .= "WITH kv.keyword = k.keywordId WHERE ";
                for ($i = 0; $i <= $characters_entered_amount; $i++) {
                    $consulta_2 .= "k.keywordContent = '" . $word_entered[$i] . "' OR ";
                }
                $consulta_2 .= "k.keywordContent = '' ORDER BY ";
                $consulta_2 .= "v.videoLikes DESC, ";
                $consulta_2 .= "v.videoAmountViews DESC, ";
                $consulta_2 .= "v.videoAmountComments DESC, ";
                $consulta_2 .= "v.videoDislikes ASC, ";
                $consulta_2 .= "v.videoUpdatedate DESC";
                
                $video = $em->createQuery(
                        $consulta_2
                )->setMaxResults(30);

                $videoInstance = $video->getResult();

                $amountVideos = 0;

                while (isset($videoInstance[$amountVideos]['videoId'])) {
                    $amountVideos++;
                }

                $i = 0;
                while (isset($videoInstance[$i]['videoId'])) {
                    
                    $videoUpdatedate = $videoInstance[$i]['videoUpdatedate'];
                    $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                    $videoAmountViews = $videoInstance[$i]['videoAmountViews'];
                    $videoAmountViewsFormat = number_format($videoAmountViews);

                    $videoAmountComments = $videoInstance[$i]['videoAmountComments'];
                    $videoAmountCommentsFormat = number_format($videoAmountComments);

                    if ($videoInstance) {
                        $videoId_Value = $videoInstance[$i]['videoId'];
                        $videoName_Value = $videoInstance[$i]['videoName'];
                        $videoDescription_Value = $videoInstance[$i]['videoDescription'];
                        $videoImage_Value = $videoInstance[$i]['videoImage'];
                        $videoContent_Value = $videoInstance[$i]['videoContent'];
                        $videoUpdatedate_Value = $videoUpdatedateString;
                        $videoAmountViews_Value = $videoAmountViewsFormat;
                        $videoAmountComments_Value = $videoAmountCommentsFormat;
                        $videoLikes_Value = $videoInstance[$i]['videoLikes'];
                        $videoDislikes_Value = $videoInstance[$i]['videoDislikes'];
                        $userId_Value = $videoInstance[$i]['userId'];
                        $userName_Value = $videoInstance[$i]['userName'];
                    } else {
                        $videoId_Value = "_";
                        $videoName_Value = "_";
                        $videoDescription_Value = "_";
                        $videoImage_Value = "_";
                        $videoContent_Value = "_";
                        $videoUpdatedate_Value = "_";
                        $videoAmountViews_Value = "_";
                        $videoAmountComments_Value = "_";
                        $videoLikes_Value = "_";
                        $videoDislikes_Value = "_";
                        $userId_Value = "_";
                        $userName_Value = "_";
                    }

                    $sendData[$i] = array(
                        'videoId' => $videoId_Value,
                        'videoName' => $videoName_Value,
                        'videoDescription' => $videoDescription_Value,
                        'videoImage' => $videoImage_Value,
                        'videoContent' => $videoContent_Value,
                        'videoUpdatedate' => $videoUpdatedate_Value,
                        'videoAmountViews' => $videoAmountViews_Value,
                        'videoAmountComments' => $videoAmountComments_Value,
                        'videoLikes' => $videoLikes_Value,
                        'videoDislikes' => $videoDislikes_Value,
                        'userId' => $userId_Value,
                        'userName' => $userName_Value,
                        'amountVideos' => $amountVideos
                    );
                    $i++;
                }

                if ($i == 0) {
                    $videoId_Value = "_";
                    $videoName_Value = "_";
                    $videoDescription_Value = "_";
                    $videoImage_Value = "_";
                    $videoContent_Value = "_";
                    $videoUpdatedate_Value = "_";
                    $videoAmountViews_Value = "_";
                    $videoAmountComments_Value = "_";
                    $videoLikes_Value = "_";
                    $videoDislikes_Value = "_";
                    $userId_Value = "_";
                    $userName_Value = "_";

                    $sendData[0] = array(
                        'videoId' => $videoId_Value,
                        'videoName' => $videoName_Value,
                        'videoDescription' => $videoDescription_Value,
                        'videoImage' => $videoImage_Value,
                        'videoContent' => $videoContent_Value,
                        'videoUpdatedate' => $videoUpdatedate_Value,
                        'videoAmountViews' => $videoAmountViews_Value,
                        'videoAmountComments' => $videoAmountComments_Value,
                        'videoLikes' => $videoLikes_Value,
                        'videoDislikes' => $videoDislikes_Value,
                        'userId' => $userId_Value,
                        'userName' => $userName_Value,
                        'amountVideos' => 0
                    );
                }

                return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
            } else {
                $videoId_Value = "_";
                $videoName_Value = "_";
                $videoDescription_Value = "_";
                $videoImage_Value = "_";
                $videoContent_Value = "_";
                $videoUpdatedate_Value = "_";
                $videoAmountViews_Value = "_";
                $videoAmountComments_Value = "_";
                $videoLikes_Value = "_";
                $videoDislikes_Value = "_";
                $userId_Value = "_";
                $userName_Value = "_";

                $sendData[0] = array(
                    'videoId' => $videoId_Value,
                    'videoName' => $videoName_Value,
                    'videoDescription' => $videoDescription_Value,
                    'videoImage' => $videoImage_Value,
                    'videoContent' => $videoContent_Value,
                    'videoUpdatedate' => $videoUpdatedate_Value,
                    'videoAmountViews' => $videoAmountViews_Value,
                    'videoAmountComments' => $videoAmountComments_Value,
                    'videoLikes' => $videoLikes_Value,
                    'videoDislikes' => $videoDislikes_Value,
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'amountVideos' => 0
                );
                return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
            }
        }
    }
    
    // replace by next functionName: manageTendenciesAction
    public function storeCurrentKeywordsAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
            $useripId = 0;
        }
        else {
            $userId = 0;
            $useripId = $this->get_useripId($em);
        }
        
        $keywords_entered_2 = $_POST["keyword"];

        
        // me retira (espacios en blanco, saltos de linea, etc) que haya al inicio de la variable $keywords_entered
        $keywords_entered_1 = ltrim($keywords_entered_2);

        // me retira (espacios en blanco, saltos de linea, etc) que haya al final de la variable $keywords_entered
        $keywords_entered = rtrim($keywords_entered_1);

        $characters_entered_amount = $this->getCharactersEnteredAmount($keywords_entered);

        $word_entered = array();
        $word_entered = $this->separateKeywords($keywords_entered);

        $this->set_keyword($em, $characters_entered_amount, $word_entered);
        $this->set_keywordUser($em, $characters_entered_amount, $word_entered, $userId, $useripId);

        if ($request->isXMLHttpRequest()) {
            $sendData[0] = array(
                '_' => "_"
            );
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
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
        } else
        {
            $this->insertar_keyword($em, $keywordContent);
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
    }
     
    
    
    
    
    
    public function set_keywordUser($em, $characters_entered_amount, $word_entered, $userId, $useripId)
    {
        $keywordContent = "";
        for ($i = 0; $i <= $characters_entered_amount; $i++)
        {
            $keywordContent.=$word_entered[$i]." ";
        }

        if ($userId === 0)
        {
            $existentedKeywordUser = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent, ku.keyworduserId, ku.keyworduserScore 
                FROM HomeBundle:Keyword k 

                JOIN HomeBundle:Keyworduser ku 
                WITH k.keywordId = ku.keyword

                JOIN HomeBundle:User u 
                WITH u.userId = ku.user 

                JOIN HomeBundle:Userip up 
                WITH up.useripId = ku.userip 

                WHERE k.keywordContent = '$keywordContent' and (u.userId = '0' and up.useripId = '$useripId')"
            );
        } else
        {
            $existentedKeywordUser = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent, ku.keyworduserId, ku.keyworduserScore 
                FROM HomeBundle:Keyword k 

                JOIN HomeBundle:Keyworduser ku 
                WITH k.keywordId = ku.keyword

                JOIN HomeBundle:User u 
                WITH u.userId = ku.user 

                JOIN HomeBundle:Userip up 
                WITH up.useripId = ku.userip 

                WHERE k.keywordContent = '$keywordContent' and (u.userId = '$userId' and up.useripId = '0')"
            );
        }

        $existentedKeywordUser_v = $existentedKeywordUser->getResult();
        // validar la existencia del keyworduser ingresado en la Base de Datos
        if (isset($existentedKeywordUser_v[0]['keywordId'])) { // si SI existe el keywordUser en la base de datos, incrementar_keywordUser_score()
            $keyworduserId = $existentedKeywordUser_v[0]['keyworduserId'];
            $keyworduserScore = $existentedKeywordUser_v[0]['keyworduserScore'];
            $this->incrementar_keywordUser_score($em, $keyworduserId, $keyworduserScore);
        } else { // si NO existe el keywordUser en la base de datos, insertar_keywordUser()
            $this->insertar_keywordUser($em, $keywordContent, $userId, $useripId);
        }
    }
    
    public function incrementar_keywordUser_score($em, $keyworduserId, $keyworduserScore)
    {
        $new_keyworduserScore = $keyworduserScore + 1;
        $keywordUser = $em->getRepository('HomeBundle:Keyworduser')->findOneByKeyworduserId($keyworduserId);
        $keywordUser->setKeyworduserScore($new_keyworduserScore);
        $em->persist($keywordUser);
        $em->flush();
    }
    
    public function insertar_keywordUser($em, $keywordContent, $userId, $useripId)
    {
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($keywordContent);
        $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
        $userip = $em->getRepository('HomeBundle:Userip')->findOneByUseripId($useripId);
        
        $keywordUser = new \HomeBundle\Entity\Keyworduser;
        $keywordUser->setKeyworduserScore(0);
        $keywordUser->setKeyword($keyword);
        $keywordUser->setUser($user);
        $keywordUser->setUserip($userip);
        $em->persist($keywordUser);
        $em->flush();
    }
    




    public function get_useripId($em)
    {
        $geolocalization = $_SERVER["REMOTE_ADDR"];
        
        $existentedUserip = $em->createQuery(
            "SELECT ui.useripId 
            FROM HomeBundle:Userip ui 
            WHERE ui.useripGeolocalization = '$geolocalization'"
        );
        
        $existentedUserip_v = $existentedUserip->getResult();

        if (isset($existentedUserip_v[0]['useripId'])) {
            $useripId = $existentedUserip_v[0]['useripId'];
        } else {
            $useripId = $this->insertar_userip($geolocalization);
        }
        return $useripId;
    }
    
    public function insertar_userip($geolocalization)
    {
        $em = $this->getDoctrine()->getManager();
        $userip = new \HomeBundle\Entity\Userip;
        $userip->setUseripGeolocalization($geolocalization);
        $em->persist($userip);
        $em->flush();
        
        $existentedUserip = $em->createQuery(
            "SELECT ui.useripId 
            FROM HomeBundle:Userip ui 
            WHERE ui.useripGeolocalization = '$geolocalization'"
        );
        $existentedUserip_v = $existentedUserip->getResult();
        $useripId = $existentedUserip_v[0]['useripId'];
        
        return $useripId;
    }
}
