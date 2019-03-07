<?php

namespace FollowingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Following/Default/index.html.twig');
    }
    
    public function getFollowingProfileAction(Request $request)
    {
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $idVideo = 1;

            $keyword = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent 
                FROM HomeBundle:Keyword k 
                JOIN HomeBundle:Keyworduser ku 
                WITH k.keywordId = ku.keyword 
                JOIN HomeBundle:User u 
                WITH u.userId = ku.user 
                WHERE u.userId = '$userId'"
            );
            
            $keyword_v = $keyword->getResult();
                        
            $amountKeywords = 0;
            while (isset($keyword_v[$amountKeywords]['keywordId'])) {
                $amountKeywords++;
            }
            
            $consulta_2 = "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, ";
            $consulta_2 .= "v.videoContent, v.videoUpdatedate, v.videoAmountViews, ";
            $consulta_2 .= "v.videoAmountComments, v.videoLikes, v.videoDislikes, u.userId, u.userName ";
            $consulta_2 .= "FROM HomeBundle:Video v ";
            $consulta_2 .= "JOIN HomeBundle:Keywordvideo kv ";
            $consulta_2 .= "WITH v.videoId = kv.video ";
            $consulta_2 .= "JOIN HomeBundle:User u ";
            $consulta_2 .= "WITH u.userId = v.user ";
            $consulta_2 .= "JOIN HomeBundle:Keyword k ";
            $consulta_2 .= "WITH kv.keyword = k.keywordId WHERE ";
            for ($i = 0; $i < $amountKeywords; $i++) {
                $consulta_2 .= "k.keywordContent = '" . $keyword_v[$i]['keywordContent'] . "' OR ";
            }
            $consulta_2 .= "k.keywordContent = ''";

            $video = $em->createQuery(
                    $consulta_2
            );
            
            
            
            $video_v = $video->getResult();
                        
            $amountVideos = 0;
            while (isset($video_v[$amountVideos]['videoId'])) {
                $amountVideos++;
            }
            
            $i = 0;
            while (isset($video_v[$i]['videoId'])) {

                if ($video_v) {
                    $videoId_Value = $video_v[$i]['videoId'];
                    $videoName_Value = $video_v[$i]['videoName'];
                    $videoDescription_Value = $video_v[$i]['videoDescription'];
                    $videoImage_Value = $video_v[$i]['videoImage'];
                    $videoContent_Value = $video_v[$i]['videoContent'];
                    $videoUpdatedate_Value = $video_v[$i]['videoUpdatedate'];
                    $videoAmountViews_Value = $video_v[$i]['videoAmountViews'];
                    $videoAmountComments_Value = $video_v[$i]['videoAmountComments'];
                    $videoLikes_Value = $video_v[$i]['videoLikes'];
                    $videoDislikes_Value = $video_v[$i]['videoDislikes'];
                    $userId_Value = $video_v[$i]['userId'];
                    $userName_Value = $video_v[$i]['userName'];
                    $amountVideos_Value = $amountVideos;
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
                    $amountVideos_Value = $amountVideos;
                }

                $videoFromUser[$i] = array(                    
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
                    'amountVideos' => $amountVideos_Value
                );
                $i++;
            }
            
            return new Response(json_encode($videoFromUser), 200, array('Content-Type' => 'application/json'));
        }
    }
}
