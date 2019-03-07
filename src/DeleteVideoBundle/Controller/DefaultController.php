<?php

namespace DeleteVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@DeleteVideo/Default/index.html.twig');
    }
    public function deleteVideoAction(Request $request)
    {
        $videoId = $_POST['videoId'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userId = $_POST['userId'];
        
        $em = $this->getDoctrine()->getManager();
            
        if ($request->isXMLHttpRequest()) {
            
            $user = $this->validateUser($em, $username, $password, $userId);
            
            if ($user)
            {                
                $dateToDeleteVideo = $this->sendRequestToDeleteVideo($em, $videoId);
                $dateToDeleteVideoString = $dateToDeleteVideo->format('d-M-Y');
            } else
            {
                $dateToDeleteVideoString = "null";
            }
            
            $users2 = array();
            $users2[0] = array(
                'dateToDeleteVideo' => $dateToDeleteVideoString
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
    
    public function sendRequestToDeleteVideo($em, $videoId)
    {
        $todayDate = date("Y-m-d");
        $nextMonthDate = strtotime('+30 day', strtotime($todayDate));
        $nextMonthDate_v2 = date ("Y-m-d", $nextMonthDate);
        $deleteRequestDate = date_create_from_format('Y-m-d', $nextMonthDate_v2);

        $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId);

        $deleteVideoRequest = new \HomeBundle\Entity\Deletevideorequest();
        $deleteVideoRequest->setDeletevideorequestDatetodelete($deleteRequestDate);
        $deleteVideoRequest->setVideo($video);
        $em->persist($deleteVideoRequest);
        $em->flush();
        return $deleteRequestDate;
    }
    
}
