<?php

namespace ArtistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Artist/Default/index.html.twig');
    }
    
    public function getArtistInformationAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $current_video_userId = $_POST['current_video_userId'];
            
            $userInformation = $em->createQuery(
                "SELECT u.userId, u.userName, u.userFirstgivenname, u.userSecondgivenname, 
                u.userFirstfamilyname, u.userSecondfamilyname, u.userEmail, u.userBiography 
                FROM HomeBundle:User u 
                WHERE u.userId = '$current_video_userId'"
            );
            $userInformation_v = $userInformation->getResult();
            
            $followers = $em->createQuery(
                "SELECT u.userId 
                FROM HomeBundle:Follow f 
                JOIN HomeBundle:User u 
                WITH f.followFollower = u.userId 
                WHERE u.userId = '$current_video_userId'"
            );
            $followers_v = $followers->getResult();

            $influencers = $em->createQuery(
                "SELECT u.userId 
                FROM HomeBundle:Follow f 
                JOIN HomeBundle:User u 
                WITH f.followInfluencer = u.userId 
                WHERE u.userId = '$current_video_userId'"
            );
            $influencers_v = $influencers->getResult();
            
            $videos = $em->createQuery(
                "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoLikes, v.videoDislikes 
                FROM HomeBundle:Video v 
                JOIN HomeBundle:User u 
                WITH v.user = u.userId 
                WHERE u.userId = '$current_video_userId'"
            );
            $videos_v = $videos->getResult();
            
            $listByUser = $em->createQuery(
                "SELECT sl.specificlistId, sl.specificlistName 
                FROM HomeBundle:Specificlist sl 
                JOIN HomeBundle:User u 
                WITH sl.user = u.userId 
                WHERE u.userId = '$current_video_userId'"
            );
            $listByUser_v = $listByUser->getResult();
            
            /////////////////////////////////////////////////
            
            $userId_value = $userInformation_v[0]['userId'];
            $userName_value = $userInformation_v[0]['userName'];
            $userFirstgivenname_value = $userInformation_v[0]['userFirstgivenname'];
            $userSecondgivenname_value = $userInformation_v[0]['userSecondgivenname'];
            $userFirstfamilyname_value = $userInformation_v[0]['userFirstfamilyname'];
            $userSecondfamilyname_value = $userInformation_v[0]['userSecondfamilyname'];
            $userEmail_value = $userInformation_v[0]['userEmail'];
            $userBiography_value = $userInformation_v[0]['userBiography'];
            
            /////////////////////////////////////////////////
            
            $amountFollowers = 0;
            while (isset($followers_v[$amountFollowers]['userId'])) {
                $amountFollowers++; // 
            }
                                    
            $amountInfluencers = 0;
            while (isset($influencers_v[$amountInfluencers]['userId'])) {
                $amountInfluencers++; // 
            }
                                    
            $amountVideos = 0;
            while (isset($videos_v[$amountVideos]['videoName'])) {
                $amountVideos++; // this is a link to show the videos that belong to the user
            }
                                                
            $amountLists = 0;
            while (isset($listByUser_v[$amountLists]['specificlistName'])) {
                $amountLists++; // this is another function, and another div 
            }
            
            $videosInformation = array();
            $videosInformation[0] = array(
                'userId' => $userId_value,
                'userName' => $userName_value,
                'userFirstgivenname' => $userFirstgivenname_value,
                'userSecondgivenname' => $userSecondgivenname_value,
                'userFirstfamilyname' => $userFirstfamilyname_value,
                'userSecondfamilyname' => $userSecondfamilyname_value,
                'userEmail' => $userEmail_value,
                'userBiography' => $userBiography_value,
                'amountFollowers' => $amountFollowers,
                'amountInfluencers' => $amountInfluencers,
                'amountVideos' => $amountVideos,
                'amountLists' => $amountLists
            );
            
            return new Response(json_encode($videosInformation), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getArtistListAction(Request $request)
    {
        $current_video_userId = $_POST['current_video_userId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($current_video_userId);

            $artistListVideo = $em->createQuery(
                "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoLikes, v.videoDislikes, u.userId, u.userName 
                FROM HomeBundle:Video v 
                JOIN HomeBundle:User u 
                WITH v.user = u.userId 
                WHERE u.userId = '$current_video_userId'"
            );

            $artistListVideo_v = $artistListVideo->getResult();
                        
            $amountVideos = 0;
            while (isset($artistListVideo_v[$amountVideos]['videoId'])) {
                $amountVideos++;
            }
            
            $i = 0;
            while (isset($artistListVideo_v[$i]['videoId'])) {
                $videoUpdatedate = $artistListVideo_v[$i]['videoUpdatedate'];
                $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                $videoAmountViews = $artistListVideo_v[$i]['videoAmountViews'];
                $videoAmountViewsFormat = number_format($videoAmountViews);

                $videoAmountComments = $artistListVideo_v[$i]['videoAmountComments'];
                $videoAmountCommentsFormat = number_format($videoAmountComments);
                
                if ($artistListVideo_v) {
                    $videoId_Value = $artistListVideo_v[$i]['videoId'];
                    $videoName_Value = $artistListVideo_v[$i]['videoName'];
                    $videoDescription_Value = $artistListVideo_v[$i]['videoDescription'];
                    $videoImage_Value = $artistListVideo_v[$i]['videoImage'];
                    $videoContent_Value = $artistListVideo_v[$i]['videoContent'];
                    $videoUpdatedate_Value = $videoUpdatedateString;
                    $videoAmountViews_Value = $videoAmountViewsFormat;
                    $videoAmountComments_Value = $videoAmountCommentsFormat;
                    $videoLikes_Value = $artistListVideo_v[$i]['videoLikes'];
                    $videoDislikes_Value = $artistListVideo_v[$i]['videoDislikes'];
                    $userId_Value = $artistListVideo_v[$i]['userId'];
                    $userName_Value = $artistListVideo_v[$i]['userName'];
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
            
            if ($i == 0)
            {
                $videoFromUser[0] = array(
                    'videoId' => "_",
                    'videoName' => "_",
                    'videoDescription' => "_",
                    'videoImage' => "_",
                    'videoContent' => "_",
                    'videoUpdatedate' => "_",
                    'videoAmountViews' => "_",
                    'videoAmountComments' => "_",
                    'videoLikes' => "_",
                    'videoDislikes' => "_",
                    'userId' => "_",
                    'userName' => "_",
                    'amountVideos' => "_"
                );                
            }
            
            return new Response(json_encode($videoFromUser), 200, array('Content-Type' => 'application/json'));
        }
    }
}