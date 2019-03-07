<?php

namespace SongBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Song/Default/index.html.twig');
    }
    
    public function getSimilarSongsAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $idVideo = 1;

            $keyword = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent 
                FROM HomeBundle:Keyword k 
                JOIN HomeBundle:Keywordvideo kv 
                WITH k.keywordId = kv.keyword 
                JOIN HomeBundle:Video v 
                WITH v.videoId = kv.video 
                WHERE v.videoId = '$idVideo'"
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
    
    public function getSpecificInformationVideoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $videoId = 1;
        
        if ($request->isXMLHttpRequest()) {

            $video = $em->createQuery(
                "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, v.videoContent, 
                v.videoUpdatedate, v.videoAmountViews, v.videoAmountComments, v.videoLikes, v.videoDislikes 
                FROM HomeBundle:Video v 
                WHERE v.videoId = '$videoId'"
            );
            
            $videoInstance = $video->getResult();

            if ($videoInstance) {
                
                $videoUpdatedate = $videoInstance[0]['videoUpdatedate'];
                $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                $videoAmountViews = $videoInstance[0]['videoAmountViews'];
                $videoAmountViewsFormat = number_format($videoAmountViews);

                $videoAmountComments = $videoInstance[0]['videoAmountComments'];
                $videoAmountCommentsFormat = number_format($videoAmountComments);
                
                
                
                $videoId_Value = $videoInstance[0]['videoId'];
                $videoName_Value = $videoInstance[0]['videoName'];
                $videoDescription_Value = $videoInstance[0]['videoDescription'];
                $videoImage_Value = $videoInstance[0]['videoImage'];
                $videoContent_Value = $videoInstance[0]['videoContent'];
                $videoUpdatedate_Value = $videoUpdatedateString;
                $videoAmountViews_Value = $videoAmountViewsFormat;
                $videoAmountComments_Value = $videoAmountCommentsFormat;
                $videoLikes_Value = $videoInstance[0]['videoLikes'];
                $videoDislikes_Value = $videoInstance[0]['videoDislikes'];
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
            }

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
                'videoDislikes' => $videoDislikes_Value
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSimilarPlaylistAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $specificList = $em->createQuery(
                "SELECT sl.specificlistId, sl.specificlistName, u.userId 
                FROM HomeBundle:Specificlist sl 
                JOIN HomeBundle:User u 
                WITH sl.user = u.userId 
                WHERE u.userId = '$userId'"
            );
            
            $specificList_v = $specificList->getResult();
                        
            $amountSpecificList = 0;
            while (isset($specificList_v[$amountSpecificList]['specificlistId'])) {
                $amountSpecificList++;
            }
            
            $i = 0;
            while (isset($specificList_v[$i]['specificlistId'])) {
                
                if ($specificList_v) {
                    $specificlistId_Value = $specificList_v[$i]['specificlistId'];
                    $specificlistName_Value = $specificList_v[$i]['specificlistName'];
                    $userId_Value = $specificList_v[$i]['userId'];
                    $amountSpecificList_Value = $amountSpecificList;
                } else {
                    $specificlistId_Value = "_";
                    $specificlistName_Value = "_";
                    $userId_Value = "_";
                    $amountSpecificList_Value = $amountSpecificList;
                }

                $videoFromUser[$i] = array(
                    'specificlistId' => $specificlistId_Value,
                    'specificlistName' => $specificlistName_Value,
                    'userId' => $userId_Value,
                    'amountSpecificList' => $amountSpecificList_Value
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $videoFromUser[0] = array(
                    'specificlistId' => "_",
                    'specificlistName' => "_",
                    'userId' => "_",
                    'amountSpecificList' => "_"
                );
            }
            
            return new Response(json_encode($videoFromUser), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function showSimilarPlaylistAction(Request $request)
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

            $history = $em->createQuery(
                "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoLikes, v.videoDislikes, u.userId, u.userName 
                FROM HomeBundle:Video v 
                JOIN HomeBundle:History h 
                WITH v.videoId = h.video 
                JOIN HomeBundle:User u 
                WITH u.userId = h.user 
                WHERE u.userId = '$userId'"
            );

            $history_v = $history->getResult();
                        
            $amountVideos = 0;
            while (isset($history_v[$amountVideos]['videoId'])) {
                $amountVideos++;
            }
            
            $i = 0;
            while (isset($history_v[$i]['videoId'])) {

                if ($history_v) {
                    $videoId_Value = $history_v[$i]['videoId'];
                    $videoName_Value = $history_v[$i]['videoName'];
                    $videoDescription_Value = $history_v[$i]['videoDescription'];
                    $videoImage_Value = $history_v[$i]['videoImage'];
                    $videoContent_Value = $history_v[$i]['videoContent'];
                    $videoUpdatedate_Value = $history_v[$i]['videoUpdatedate'];
                    $videoAmountViews_Value = $history_v[$i]['videoAmountViews'];
                    $videoAmountComments_Value = $history_v[$i]['videoAmountComments'];
                    $videoLikes_Value = $history_v[$i]['videoLikes'];
                    $videoDislikes_Value = $history_v[$i]['videoDislikes'];
                    $userId_Value = $history_v[$i]['userId'];
                    $userName_Value = $history_v[$i]['userName'];
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
    
    public function increaseAmountViewsAction(Request $request)
    {
        $current_video_id = $_POST['current_video_id'];
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($current_video_id);
            $current_video_amount_views = $video->getVideoAmountViews();
            $new_video_amount_views = $current_video_amount_views + 1;
            $video->setVideoAmountViews($new_video_amount_views);
            $em->persist($video);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'current_video_amount_views' => $current_video_amount_views
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
}
