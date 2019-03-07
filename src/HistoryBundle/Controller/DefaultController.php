<?php

namespace HistoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@History/Default/index.html.twig');
    }
    
    public function getHistorySongsAction(Request $request)
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
            
            if (isset($history_v[0]['videoId'])) {
                
            } else
            {
                $videoFromUser[0] = array(                    
                    'videoId' => "-",
                    'videoName' => "-",
                    'videoDescription' => "-",
                    'videoImage' => "-",
                    'videoContent' => "-",
                    'videoUpdatedate' => "-",
                    'videoAmountViews' => "-",
                    'videoAmountComments' => "-",
                    'videoLikes' => "-",
                    'videoDislikes' => "-",
                    'userId' => "-",
                    'userName' => "-",
                    'amountVideos' => "-"
                );
            }
            
            return new Response(json_encode($videoFromUser), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}
