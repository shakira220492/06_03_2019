<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class h_TaskController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/home/home.html.twig');
    }
    
    public function getTaskPropertiesAction(Request $request)
    {
//        $keyword_name = $_POST["keywordName"];

        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

//            $idUser = $_SESSION['loginSession'];
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
            $idEnvironment = 1;
            $environment = $em->getRepository('HomeBundle:Environment')->findOneByEnvironmentId($idEnvironment);
            
            $task = new Task();
            
            $task->setEnvironment($environment);
            $task->setUser($user);
            
            $em->persist($task);
            $em->flush();

            $amountLikesCommentary = array();

            $amountLikesCommentary[0] = array(
                'keyword_name' => "queen"
            );

            return new Response(json_encode($amountLikesCommentary), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}