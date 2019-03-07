<?php

namespace DataminingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Datamining/Default/index.html.twig');
    }
    
    public function getKeywordUsersAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                $useripId = 0;
            }
            else {
                $userId = 0;
                $useripId = $this->get_useripId($em);
            }
            
            if ($userId != 0)
            {
                $keyword = $em->createQuery(
                    "SELECT DISTINCT k.keywordId, k.keywordContent, ku.keyworduserId, ku.keyworduserScore 
                    FROM HomeBundle:Keyworduser ku 

                    JOIN HomeBundle:Keyword k 
                    WITH ku.keyword = k.keywordId 

                    JOIN HomeBundle:User u 
                    WITH ku.user = u.userId

                    JOIN HomeBundle:Userip ui
                    WITH ku.userip = ui.useripId

                    WHERE u.userId = '$userId' and ui.useripId = '0'

                    ORDER BY ku.keyworduserScore DESC"
                )->setMaxResults(60); 
                $keyword_e = $keyword->getResult();
            } else 
            {
                $keyword = $em->createQuery(
                    "SELECT DISTINCT k.keywordId, k.keywordContent, ku.keyworduserId, ku.keyworduserScore 
                    FROM HomeBundle:Keyworduser ku 

                    JOIN HomeBundle:Keyword k 
                    WITH ku.keyword = k.keywordId 

                    JOIN HomeBundle:User u 
                    WITH ku.user = u.userId

                    JOIN HomeBundle:Userip ui
                    WITH ku.userip = ui.useripId

                    WHERE u.userId = '0' and ui.useripId = '$useripId'

                    ORDER BY ku.keyworduserScore DESC"
                )->setMaxResults(60); 
                $keyword_e = $keyword->getResult();
            }

            $amountKeywords = 0;
            while (isset($keyword_e[$amountKeywords]['keywordId'])) {
                $amountKeywords++;
            }
            
            $keywords = 0;
            while ($keywords < $amountKeywords) {
                if (isset($keyword_e[$keywords]['keywordId']))
                {
                    $videosInformation[$keywords] = array(
                        'keywordId' => $keyword_e[$keywords]['keywordId'],
                        'keywordContent' => $keyword_e[$keywords]['keywordContent'],
                        'keyworduserScore' => $keyword_e[$keywords]['keyworduserScore'],
                        'amountKeywords' => $amountKeywords
                    );
                    $keywords++;
                }
            }
            
            if ($keywords === 0)
            {
                $videosInformation[$keywords] = array(
                    'keywordId' => 0,
                    'keywordContent' => "",
                    'keyworduserScore' => "",
                    'amountKeywords' => 0
                );
            }
            
            return new Response(json_encode($videosInformation), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getVideosPerKeywordUsersAction(Request $request)
    {
        $keywordId = $_POST['keywordId'];
        $keywordContent = $_POST['keywordContent'];
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $video = $em->createQuery(
                "SELECT DISTINCT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoLikes, v.videoDislikes, 
                u.userId, u.userName, 
                k.keywordId, k.keywordContent 

                FROM HomeBundle:Video v 

                JOIN HomeBundle:User u 
                WITH u.userId = v.user 

                JOIN HomeBundle:Keywordvideo kv 
                WITH kv.video = v.videoId 

                JOIN HomeBundle:Keyword k 
                WITH k.keywordId = kv.keyword 

                WHERE k.keywordId = '$keywordId'
                "
            );
            $video_e = $video->getResult();
            $amountVideos = 0;
            while (isset($video_e[$amountVideos]['videoId'])) 
            {
                $amountVideos++;
            }
            $videos = 0;
            while ($videos < $amountVideos) {
                if (isset($video_e[$videos]['videoId'])) {

                    $videoUpdatedate = $video_e[$videos]['videoUpdatedate'];
                    $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                    $videoAmountViews = $video_e[$videos]['videoAmountViews'];
                    $videoAmountViewsFormat = number_format($videoAmountViews);

                    $videoAmountComments = $video_e[$videos]['videoAmountComments'];
                    $videoAmountCommentsFormat = number_format($videoAmountComments);

                    $videoId_Value = $video_e[$videos]['videoId'];
                    $videoName_Value = $video_e[$videos]['videoName'];
                    $videoDescription_Value = $video_e[$videos]['videoDescription'];
                    $videoImage_Value = $video_e[$videos]['videoImage'];
                    $videoContent_Value = $video_e[$videos]['videoContent'];
                    $videoUpdatedate_Value = $videoUpdatedateString;
                    $videoAmountViews_Value = $videoAmountViewsFormat;
                    $videoAmountComments_Value = $videoAmountCommentsFormat;
                    $videoLikes_Value = $video_e[$videos]['videoLikes'];
                    $videoDislikes_Value = $video_e[$videos]['videoDislikes'];
                    $userId_Value = $video_e[$videos]['userId'];
                    $userName_Value = $video_e[$videos]['userName'];
                    $keywordId_Value = $video_e[$videos]['keywordId'];
                    $keywordContent_Value = $video_e[$videos]['keywordContent'];

                    $videosInformation[$videos] = array(
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
                        'keywordId' => $keywordId_Value,
                        'keywordContent' => $keywordContent_Value,
                        'amountVideos' => $amountVideos
                    );

                }
                $videos++;
            }
            
            if ($videos === 0)
            {
                $videosInformation[0] = array(
                    'videoId' => 0,
                    'videoName' => "",
                    'videoDescription' => "",
                    'videoImage' => "",
                    'videoContent' => "",
                    'videoUpdatedate' => "",
                    'videoAmountViews' => 0,
                    'videoAmountComments' => 0,
                    'videoLikes' => 0,
                    'videoDislikes' => 0,
                    'userId' => 0,
                    'userName' => "",
                    'keywordId' => $keywordId,
                    'keywordContent' => $keywordContent,
                    'amountVideos' => 0
                );
            }
            
            return new Response(json_encode($videosInformation), 200, array('Content-Type' => 'application/json'));
        }
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
            $useripId = $this->insertar_userip($em, $geolocalization);
        }
        return $useripId;
    }
    
    public function insertar_userip($em, $geolocalization)
    {
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