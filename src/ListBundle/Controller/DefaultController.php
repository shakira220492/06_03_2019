<?php

namespace ListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('@List/Default/index.html.twig');
    }

    public function setSpecificListAction(Request $request) {
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $nameOfListId = $_POST['nameOfListId'];
            
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
            
            
            $specificList = new \HomeBundle\Entity\Specificlist;
            $specificList->setSpecificlistName($nameOfListId);
            $specificList->setUser($user);

            $em->persist($specificList);
            $em->flush();
            
            
            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => $specificList->getSpecificlistId(),
                    'specificlistName' => $specificList->getSpecificlistName(),
                    'userId' => $specificList->getUser()
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSpecificListAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $query = $em->createQuery(
                "SELECT sl.specificlistId, sl.specificlistName, u.userId, u.userName 
                FROM HomeBundle:Specificlist sl 
                JOIN HomeBundle:User u 
                WITH sl.user = u.userId
                WHERE u.userId = '$userId'
                "
            );

            $specificlist = $query->getResult();

            $amountLists = 0;

            while (isset($specificlist[$amountLists]['specificlistName'])) {
                $amountLists++;
            }

            $i = 0;
            while (isset($specificlist[$i]['specificlistId'])) {

                if ($specificlist) {
                    $specificlistId_Value = $specificlist[$i]['specificlistId'];
                    $specificlistName_Value = $specificlist[$i]['specificlistName'];
                    $userId_Value = $specificlist[$i]['userId'];
                    $userName_Value = $specificlist[$i]['userName'];
                } else {
                    $specificlistId_Value = "_";
                    $specificlistName_Value = "_";
                    $userId_Value = "_";
                    $userName_Value = "_";
                }

                $sendData[$i] = array(
                    'specificlistId' => $specificlistId_Value,
                    'specificlistName' => $specificlistName_Value,
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'amountLists' => $amountLists
                );
                $i++;
            }
            
            if ($i === 0)
            {
                $sendData[$i] = array(
                    'specificlistId' => "_",
                    'specificlistName' => "_",
                    'userId' => "_",
                    'userName' => "_",
                    'amountLists' => "_"
                );                
            }

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function setSpecificListVideoAction(Request $request) {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $specificlistId = $_POST['specificlistId'];
            $videoId = $_POST['videoId'];

            $specificList = $em->getRepository('HomeBundle:Specificlist')->findOneBySpecificlistId($specificlistId);
            $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId);

            $specificListVideo = new \HomeBundle\Entity\Specificlistvideo;
            $specificListVideo->setSpecificlist($specificList);
            $specificListVideo->setVideo($video);
            
            $em->persist($specificListVideo);
            $em->flush();

            $specificListVideoId = $specificListVideo->getSpecificlistvideoId();
            
            $users2 = array();
            $users2[0] = array(
                'specificListVideoId' => $specificListVideoId
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function getSpecificListVideoAction(Request $request) {
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        $em = $this->getDoctrine()->getManager();

//        $sessionId = $_POST['sessionId'];
//        $fieldName = $_POST['fieldName'];

//        specificlistId: specificlistId
        $specificlistId = $_POST['specificlistId'];
        

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $query = $em->createQuery(
                "SELECT slv.specificlistvideoId, sl.specificlistId, u.userId, u.userName, 
                v.videoId, v.videoName, v.videoDescription, v.videoImage, v.videoContent, v.videoUpdatedate, v.videoAmountViews, v.videoAmountComments, v.videoLikes, v.videoDislikes 
                FROM HomeBundle:Specificlistvideo slv 
                JOIN HomeBundle:Video v 
                WITH slv.video = v.videoId 
                JOIN HomeBundle:Specificlist sl 
                WITH slv.specificlist = sl.specificlistId 
                JOIN HomeBundle:User u 
                WITH sl.user = u.userId 
                WHERE sl.specificlistId = '$specificlistId'"
            );

            $specificlistvideo = $query->getResult();
            
            $amountVideos = 0;
                    
            while (isset($specificlistvideo[$amountVideos]['specificlistvideoId'])) {
                $amountVideos++;
            }
            
            $i = 0;
            if (isset($specificlistvideo[$i]['specificlistId'])) {

                while (isset($specificlistvideo[$i]['specificlistId'])) {
                    if ($specificlistvideo) {
                        $specificlistvideoId_Value = $specificlistvideo[$i]['specificlistvideoId'];
                        $specificlist_Value = $specificlistvideo[$i]['specificlistId'];
                        $userId_Value = $specificlistvideo[$i]['userId'];
                        $userName_Value = $specificlistvideo[$i]['userName'];
                        $videoId_Value = $specificlistvideo[$i]['videoId'];
                        $videoName_Value = $specificlistvideo[$i]['videoName'];
                        $videoDescription_Value = $specificlistvideo[$i]['videoDescription'];
                        $videoImage_Value = $specificlistvideo[$i]['videoImage'];
                        $videoContent_Value = $specificlistvideo[$i]['videoContent'];
                        $videoUpdatedate_Value = $specificlistvideo[$i]['videoUpdatedate'];
                        $videoAmountViews_Value = $specificlistvideo[$i]['videoAmountViews'];
                        $videoAmountComments_Value = $specificlistvideo[$i]['videoAmountComments'];
                        $videoLikes_Value = $specificlistvideo[$i]['videoLikes'];
                        $videoDislikes_Value = $specificlistvideo[$i]['videoDislikes'];
                    } else {
                        $specificlistvideoId_Value = "_";
                        $specificlist_Value = "_";
                        $userId_Value = "_";
                        $userName_Value = "_";
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

                    $sendData[$i] = array(
                        'specificlistvideoId' => $specificlistvideoId_Value,
                        'specificlist' => $specificlist_Value,
                        'userId' => $userId_Value,
                        'userName' => $userName_Value,
                        'amountVideos' => $amountVideos,
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

                    $i++;
                }
                
            } else {
                $sendData[0] = array(
                    'specificlistvideoId' => 0,
                    'specificlist' => 0,
                    'userId' => 0,
                    'userName' => 0,
                    'amountVideos' => 0,
                    'videoId' => 0,
                    'videoName' => 0,
                    'videoDescription' => 0,
                    'videoImage' => 0,
                    'videoContent' => 0,
                    'videoUpdatedate' => 0,
                    'videoAmountViews' => 0,
                    'videoAmountComments' => 0,
                    'videoLikes' => 0,
                    'videoDislikes' => 0
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function deleteSpecificListAction(Request $request) {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

//            $idSpecificList = 4;
            $specificlistId = $_POST['specificlistId'];

            $specificList = $em->getRepository('HomeBundle:Specificlist')->findOneBySpecificlistId($specificlistId);
//            $specificList = $em->getRepository('HomeBundle:Specificlist')->findOneById(4);
            
            $em->remove($specificList);
            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function deleteSpecificListVideoAction(Request $request) {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

//            $idSpecificListVideo = 469;
            $specificlistvideoId = $_POST['specificlistvideoId'];

            $specificListVideo = $em->getRepository('HomeBundle:Specificlistvideo')->findOneBySpecificlistvideoId($specificlistvideoId);
            
            $em->remove($specificListVideo);
            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function editSpecificListVideoAction(Request $request) {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

//            $idSpecificListVideo = 469;
            $specificlistvideoId = $_POST['specificlistvideoId'];

            $specificListVideo = $em->getRepository('HomeBundle:Specificlistvideo')->findOneBySpecificlistvideoId($specificlistvideoId);
            
            $em->remove($specificListVideo);
            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function editSpecificListAction(Request $request) {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $specificlistId = $_POST['specificlistId'];
            $specificlistName = $_POST['specificlistName'];
            
            $specificList = $em->getRepository('HomeBundle:Specificlist')->findOneBySpecificlistId($specificlistId);
            
            $specificList->setSpecificlistName($specificlistName);
            
            $em->persist($specificList);
            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function playSpecificListAction(Request $request) {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $specificlistId = $_POST['specificlistId'];
            
            $query = $em->createQuery(
                "SELECT slv.specificlistvideoId, sl.specificlistId, u.userName, 
                v.videoId, v.videoName, v.videoDescription, v.videoImage, v.videoContent, v.videoUpdatedate, v.videoAmountViews, v.videoLikes, v.videoDislikes 
                FROM HomeBundle:Specificlistvideo slv 
                JOIN HomeBundle:Video v 
                WITH slv.video = v.videoId 
                JOIN HomeBundle:Specificlist sl 
                WITH slv.specificlist = sl.specificlistId 
                JOIN HomeBundle:User u 
                WITH sl.user = u.userId 
                WHERE sl.specificlistId = '$specificlistId'"
            );

            $specificlistvideo = $query->getResult();
            
//            $specificlistId = $_POST['specificlistId'];
//            $specificlistName = $_POST['specificlistName'];
//            
//            $specificList = $em->getRepository('HomeBundle:Specificlist')->findOneBySpecificlistId($specificlistId);
//            
//            $specificList->setSpecificlistName($specificlistName);
//            
//            $em->persist($specificList);
//            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}