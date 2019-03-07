<?php

namespace DeclineDeleteVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@DeclineDeleteVideo/Default/index.html.twig');
    }
    
    public function getVideosToDeleteAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            
            $videosToDelete = $em->createQuery(
                "SELECT DISTINCT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoLikes, v.videoDislikes, 
                u.userId, u.userName, 
                dvr.deletevideorequestDatetodelete 
                FROM HomeBundle:Video v 
                
                JOIN HomeBundle:Deletevideorequest dvr 
                WITH dvr.video = v.videoId 
                
                JOIN HomeBundle:User u 
                WITH v.user = u.userId 
                
                WHERE u.userId = '$userId'"
            );
            $videosToDelete_v = $videosToDelete->getResult();
                    
            $amountVideos = 0;
            while (isset($videosToDelete_v[$amountVideos]['videoId'])) {
                $amountVideos++;
            }
            
            
            $i = 0;
            while (isset($videosToDelete_v[$i]['videoId'])) {
                if ($videosToDelete_v) {
                    
                    $videoUpdatedate = $videosToDelete_v[$i]['videoUpdatedate'];
                    $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                    $videoAmountViews = $videosToDelete_v[$i]['videoAmountViews'];
                    $videoAmountViewsFormat = number_format($videoAmountViews);

                    $videoAmountComments = $videosToDelete_v[$i]['videoAmountComments'];
                    $videoAmountCommentsFormat = number_format($videoAmountComments);

                    $deletevideorequestDatetodelete = $videosToDelete_v[$i]['deletevideorequestDatetodelete'];
                    $datetodelete_String = $deletevideorequestDatetodelete->format('d-M-Y');
                    
                    $videoId_Value = $videosToDelete_v[$i]['videoId'];
                    $videoName_Value = $videosToDelete_v[$i]['videoName'];
                    $videoDescription_Value = $videosToDelete_v[$i]['videoDescription'];
                    $videoImage_Value = $videosToDelete_v[$i]['videoImage'];
                    $videoContent_Value = $videosToDelete_v[$i]['videoContent'];
                    $videoUpdatedate_Value = $videoUpdatedateString;
                    $videoAmountViews_Value = $videoAmountViewsFormat;
                    $videoAmountComments_Value = $videoAmountCommentsFormat;
                    $videoLikes_Value = $videosToDelete_v[$i]['videoLikes'];
                    $videoDislikes_Value = $videosToDelete_v[$i]['videoDislikes'];
                    $userId_Value = $videosToDelete_v[$i]['userId'];
                    $userName_Value = $videosToDelete_v[$i]['userName'];
                    $datetodelete_Value = $datetodelete_String;
                    $amountVideos_Value = $amountVideos;
                }
                else {
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
                    $datetodelete_Value = "_";
                    $amountVideos_Value = $amountVideos;
                }
                    
                $users2[$i] = array(
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
                    'datetodelete' => $datetodelete_Value,
                    'amountVideos' => $amountVideos_Value
                );
                    
                $i++;
            }
            
            if ($i === 0) {
                $users2[0] = array(
                    'deletevideorequestDatetodelete' => "-",
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
                    'datetodelete' => "-",
                    'amountVideos' => 0
                );
            }
            

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function declineDeleteVideoAction(Request $request)
    {
        $videoId = $_POST['videoId'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userId = $_POST['userId'];
        
        $em = $this->getDoctrine()->getManager();
        
        if ($request->isXMLHttpRequest()) {

            $user = $this->validateUser($em, $username, $password, $userId);
            
            $declineDeleteVideo = "false";
            
            if ($user)
            {                
                $deletevideorequest = $this->deleteVideoRequest($em, $videoId);
                
                if ($deletevideorequest)
                {
                    $declineDeleteVideo = "true";
                }
            }
            
            $users2 = array();
            $users2[0] = array(
                'declineDeleteVideo' => $declineDeleteVideo
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function validateUser($em, $username, $password, $userId)
    {
        $user = $em->createQuery(
            "SELECT u.userId, u.userName, u.userFirstgivenname, 
            u.userSecondgivenname, u.userFirstfamilyname, u.userSecondfamilyname, 
            u.userEmail, u.userBiography 
            FROM HomeBundle:User u 
            WHERE u.userName = '$username' and u.userPassword = '$password' and u.userId = '$userId'" 
        )->setMaxResults(1);

        $users = $user->getResult();
        
        if (!$users) {
            return FALSE;
        } else
        {
            return TRUE;
        }
    }
    
    public function deleteVideoRequest($em, $videoId)
    {
        $deleteVideoRequest = $em->createQuery(
            "SELECT DISTINCT v.videoId, dvr.deletevideorequestId 
            FROM HomeBundle:Video v 

            JOIN HomeBundle:Deletevideorequest dvr 
            WITH dvr.video = v.videoId 

            WHERE v.videoId = '$videoId'"
        );
        $deleteVideoRequest_v = $deleteVideoRequest->getResult();

        if (isset($deleteVideoRequest_v[0]['deletevideorequestId']))
        {
            $deletevideorequestId = $deleteVideoRequest_v[0]['deletevideorequestId'];
        
            $deleteVideoRequest = $em->getRepository('HomeBundle:Deletevideorequest')->findOneByDeletevideorequestId($deletevideorequestId);
            $em->remove($deleteVideoRequest);
            $em->flush();
            return TRUE;
        } else
        {
            return FALSE;
        }
    }
    
}
