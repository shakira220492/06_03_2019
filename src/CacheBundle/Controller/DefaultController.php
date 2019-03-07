<?php

namespace CacheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Cache/Default/index.html.twig');
    }
    
    public function setCacheListAction(Request $request) {
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $cacheList = new \HomeBundle\Entity\Cachelist;
            $cacheList->setUser($user);

            $em->persist($cacheList);
            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function getCacheListAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $cacheList = $em->createQuery(
                "SELECT c.cachelistId, u.userId 
                FROM HomeBundle:Cachelist c 
                JOIN HomeBundle:User u 
                WITH c.user = u.userId 
                WHERE c.cachelistId = '1'"
            )->setMaxResults(30);

            $cacheList_v = $cacheList->getResult();

            if ($cacheList_v) {
                $cachelistId_Value = $cacheList_v[0]['cachelistId'];
                $userId_Value = $cacheList_v[0]['userId'];
            } else {
                $cachelistId_Value = "_";
                $userId_Value = "_";
            }

            $sendData[0] = array(
                'cachelistId' => $cachelistId_Value,
                'userId' => $userId_Value
            );
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function setCacheListVideoAction(Request $request) {

        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $idVideo = 1;

            $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($idVideo);

            $cacheListVideo = new \HomeBundle\Entity\Cachelistvideo;
            $cacheListVideo->setCachelist(1);
            $cacheListVideo->setVideo($video);

            $em->persist($cacheListVideo);
            $em->flush();

            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function getCacheListVideoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

//        $fieldName = $_POST['fieldName'];

        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $cacheListVideo = $em->createQuery(
                "SELECT clv.cachelistvideoId, cl.cachelistId, v.videoId 
                FROM HomeBundle:Cachelistvideo clv 
                JOIN HomeBundle:Cachelist cl 
                WITH cl.cachelistId = clv.cachelist 
                JOIN HomeBundle:Video v 
                WITH v.videoId = clv.video 
                WHERE clv.cachelistvideoId = '1'"
            );

            $cacheListVideo_v = $cacheListVideo->getResult();

            if ($cacheListVideo_v) {
                $cachelistvideoId_Value = $cacheListVideo_v[0]['cachelistvideoId'];
                $cachelistId_Value = $cacheListVideo_v[0]['cachelistId'];
                $videoId_Value = $cacheListVideo_v[0]['videoId'];
            } else {
                $cachelistvideoId_Value = "_";
                $cachelistId_Value = "_";
                $videoId_Value = "_";
            }

            $sendData[0] = array(
                'cachelistvideoId' => $cachelistvideoId_Value,
                'cachelistId' => $cachelistId_Value,
                'videoId' => $videoId_Value
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
}