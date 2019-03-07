<?php

namespace PlayBannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@PlayBanner/Default/index.html.twig');
    }
    
    public function getVideoSpeedAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        $geolocalization = $_SERVER["REMOTE_ADDR"];

        if ($request->isXMLHttpRequest()) {
        
            if ($userId === 0)
            {
                $em = $this->getDoctrine()->getManager();
                
                $windowByGeolocalization = $em->createQuery(
                    "SELECT w.windowId, w.windowVideospeed, w.windowGeolocalization 
                    FROM HomeBundle:Window w 
                    JOIN HomeBundle:User u 
                    WITH w.user = u.userId
                    WHERE w.windowGeolocalization = '$geolocalization'
                    "
                );
                
                $windowByGeolocalization_e = $windowByGeolocalization->getResult();
                
                if (isset($windowByGeolocalization_e[0]['windowId'])) 
                {
                    // windowByGeolocalization
                    $windowId_Value = $windowByGeolocalization_e[0]['windowId'];
                    $windowVideospeed_Value = $windowByGeolocalization_e[0]['windowVideospeed'];
                    $windowGeolocalization_Value = $windowByGeolocalization_e[0]['windowGeolocalization'];

                    $sendData = array();
                    $sendData[0] = array(
                        'windowId' => $windowId_Value,
                        'windowVideospeed' => $windowVideospeed_Value,
                        'windowGeolocalization' => $windowGeolocalization_Value
                    );
                } else
                {
                    // windowByDefault
                    $sendData = array();
                    $sendData[0] = array(
                        'windowId' => "_",
                        'windowVideospeed' => "_",
                        'windowGeolocalization' => "_"
                    );
                }
            } 
            else 
            {
                $em = $this->getDoctrine()->getManager();
                
                $windowByUser = $em->createQuery(
                    "SELECT w.windowId, w.windowVideospeed, w.windowGeolocalization 
                    FROM HomeBundle:Window w 
                    JOIN HomeBundle:User u 
                    WITH w.user = u.userId 
                    WHERE u.userId = '$userId'"
                );
                
                $windowByUser_e = $windowByUser->getResult();
                
                
                if (isset($windowByUser_e[0]['windowId'])) 
                {
                    // windowByUser
                    $windowId_Value = $windowByUser_e[0]['windowId'];
                    $windowVideospeed_Value = $windowByUser_e[0]['windowVideospeed'];
                    $windowGeolocalization_Value = $windowByUser_e[0]['windowGeolocalization'];

                    $sendData = array();
                    $sendData[0] = array(
                        'windowId' => $windowId_Value,
                        'windowVideospeed' => $windowVideospeed_Value,
                        'windowGeolocalization' => $windowGeolocalization_Value
                    );
                    
                    
                } else
                {
                    // windowByDefault
                    $sendData = array();
                    $sendData[0] = array(
                        'windowId' => "_",
                        'windowVideospeed' => "_",
                        'windowGeolocalization' => "_"
                    );
                }
                
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function setVideoSpeedAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $video_speed = $_POST['video_speed'];
            $geolocalization = $_SERVER["REMOTE_ADDR"];
            
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
            
            
            // si no existe el window, entonces crearla 
            
            
            $window = $em->getRepository('HomeBundle:Window')->findOneByUser($user);
            
            if (!$window)
            {
                $window = new \HomeBundle\Entity\Window;
                $window->setUser($user);
                $window->setWindowConfigurationareasize(0);
                $window->setWindowGeolocalization($geolocalization);
                $window->setWindowVideosize(0);
                $window->setWindowVideospeed($video_speed);
                $window->setWindowVolume(0);
                
                $em->persist($window);
                $em->flush();
            } else {
                $window->setWindowGeolocalization($geolocalization);
                $window->setWindowVideospeed($video_speed);
                $window->setUser($user);

                $em->persist($window);
                $em->flush();
            }
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
}