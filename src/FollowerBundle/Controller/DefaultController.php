<?php

namespace FollowerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Follower/Default/index.html.twig');
    }
    
    public function getFollowersProfileAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $followers = $em->createQuery(
                "SELECT u.userId, u.userName, u.userFirstgivenname, u.userFirstfamilyname 
                FROM HomeBundle:Follow f 
                JOIN HomeBundle:User u 
                WITH f.followFollower = u.userId 
                WHERE f.followInfluencer = '$userId'"
            );
            $followers_v = $followers->getResult();
            
            $amountFollowers = 0;
            while (isset($followers_v[$amountFollowers]['userId'])) {
                $amountFollowers++; // this is another function, and another div 
            }
            
            $i = 0;
            while (isset($followers_v[$i]['userId'])) {
                
                if ($followers_v) {
                    $userId_Value = $followers_v[$i]['userId'];
                    $userName_Value = $followers_v[$i]['userName'];
                    $userFirstgivenname_Value = $followers_v[$i]['userFirstgivenname'];
                    $userFirstfamilyname_Value = $followers_v[$i]['userFirstfamilyname'];
                    $amountFollowers_Value = $amountFollowers;
                } else {
                    $userId_Value = "_";
                    $userName_Value = "_";
                    $userFirstgivenname_Value = "_";
                    $userFirstfamilyname_Value = "_";
                    $amountFollowers_Value = $amountFollowers;
                }

                $follower[$i] = array(
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'userFirstgivenname' => $userFirstgivenname_Value,
                    'userFirstfamilyname' => $userFirstfamilyname_Value,
                    'amountFollowers' => $amountFollowers_Value
                );
                $i++;
            }
            
            if (isset($followers_v[0]['userId'])) {
                
            } else
            {
                $follower[0] = array(
                    'userId' => "-",
                    'userName' => "-",
                    'userFirstgivenname' => "-",
                    'userFirstfamilyname' => "-",
                    'amountFollowers' => "-"
                );
            }
            
            return new Response(json_encode($follower), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    function getFollowerInformationAction(Request $request)
    {
        $userId = $_POST['userId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $user = $em->createQuery(
                "SELECT u.userId, u.userName, u.userFirstgivenname, u.userSecondgivenname, 
                u.userFirstfamilyname, u.userSecondfamilyname, u.userEmail, u.userBiography, u.userProfilephoto 
                FROM HomeBundle:User u 
                WHERE u.userId = '$userId'"
            );
            $user_v = $user->getResult();
            
            $followers = $em->createQuery(
                "SELECT u.userId 
                FROM HomeBundle:Follow f 
                JOIN HomeBundle:User u 
                WITH f.followFollower = u.userId 
                WHERE u.userId = '$userId'"
            );
            $followers_v = $followers->getResult();
            
            $amountFollowers = 0;
            while (isset($followers_v[$amountFollowers]['userId'])) {
                $amountFollowers++; // this is another function, and another div 
            }
            
            if ($followers_v) {
                $userId_Value = $user_v[0]['userId'];
                $userName_Value = $user_v[0]['userName'];
                $userFirstgivenname_Value = $user_v[0]['userFirstgivenname'];
                $userSecondgivenname_Value = $user_v[0]['userSecondgivenname'];
                $userFirstfamilyname_Value = $user_v[0]['userFirstfamilyname'];
                $userSecondfamilyname_Value = $user_v[0]['userSecondfamilyname'];
                $userEmail_Value = $user_v[0]['userEmail'];
                $userBiography_Value = $user_v[0]['userBiography'];
                $userProfilephoto_Value = $user_v[0]['userProfilephoto'];
                $amountFollowers_Value = $amountFollowers;
            } else {
                $userId_Value = "_";
                $userName_Value = "_";
                $userFirstgivenname_Value = "_";
                $userSecondgivenname_Value = "_";
                $userFirstfamilyname_Value = "_";
                $userSecondfamilyname_Value = "_";
                $userEmail_Value = "_";
                $userBiography_Value = "_";
                $userProfilephoto_Value = "_";
                $amountFollowers_Value = $amountFollowers;
            }
            
            $follower[0] = array(
                'userId' => $userId_Value,
                'userName' => $userName_Value,
                'userFirstgivenname' => $userFirstgivenname_Value,
                'userSecondgivenname' => $userSecondgivenname_Value,
                'userFirstfamilyname' => $userFirstfamilyname_Value,
                'userSecondfamilyname' => $userSecondfamilyname_Value,
                'userEmail' => $userEmail_Value,
                'userBiography' => $userBiography_Value,
                'userProfilephoto' => $userProfilephoto_Value,
                'amountFollowers' => $amountFollowers_Value
            );
            
            return new Response(json_encode($follower), 200, array('Content-Type' => 'application/json'));
        }
        
    }
    
}
