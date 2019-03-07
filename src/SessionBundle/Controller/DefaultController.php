<?php

namespace SessionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Session/Default/index.html.twig');
    }
    
    public function checkSessionAction(Request $request) {
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                
                $amountFollowers = $this->get_amountFollowers($userId, $em);
                $amountInfluencers = $this->get_amountInfluencers($userId, $em);
                $amountVideos = $this->get_amountVideos($userId, $em);
                $amountSpecificLists = $this->get_amountSpecificLists($userId, $em);

                $user = $em->createQuery(
                    "SELECT u.userId, u.userName, u.userFirstgivenname, 
                    u.userSecondgivenname, u.userFirstfamilyname, u.userSecondfamilyname, 
                    u.userEmail, u.userPassword, u.userBiography 
                    FROM HomeBundle:User u 
                    WHERE u.userId = $userId"
                );

                $users = $user->getResult();

                $userId_Value = $users[0]['userId'];
                $userName_Value = $users[0]['userName'];
                $userFirstgivenname_Value = $users[0]['userFirstgivenname'];
                $userSecondgivenname_Value = $users[0]['userSecondgivenname'];
                $userFirstfamilyname_Value = $users[0]['userFirstfamilyname'];
                $userSecondfamilyname_Value = $users[0]['userSecondfamilyname'];
                $userEmail_Value = $users[0]['userEmail'];
                $userPassword_Value = $users[0]['userPassword'];
                $userBiography_Value = $users[0]['userBiography'];

                $users2 = array();
                $users2[] = array(
                    'sessionStatus' => "1",
                    'sessionId' => $userId_Value,
                    'userName' => $userName_Value,
                    'userFirstgivenname' => $userFirstgivenname_Value,
                    'userSecondgivenname' => $userSecondgivenname_Value,
                    'userFirstfamilyname' => $userFirstfamilyname_Value,
                    'userSecondfamilyname' => $userSecondfamilyname_Value,
                    'userEmail' => $userEmail_Value,
                    'userPassword' => $userPassword_Value,
                    'userBiography' => $userBiography_Value,
                    'amountFollowers' => $amountFollowers,
                    'amountInfluencers' => $amountInfluencers,
                    'amountVideos' => $amountVideos,
                    'amountSpecificLists' => $amountSpecificLists
                );
                
            }
            else {
                // en caso de que no exista una sesión
                $users2 = array();
                $users2[] = array(
                    'sessionStatus' => "0",
                    'sessionId' => "logOut",
                    'userName' => "_",
                    'userFirstgivenname' => "_",
                    'userSecondgivenname' => "_",
                    'userFirstfamilyname' => "_",
                    'userSecondfamilyname' => "_",
                    'userEmail' => "_",
                    'userPassword' => "_",
                    'userBiography' => "_",
                    'amountFollowers' => "_",
                    'amountInfluencers' => "_",
                    'amountVideos' => "_",
                    'amountSpecificLists' => "_"
                );
            }
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function get_amountFollowers($userId, $em)
    {
        $followers = $em->createQuery(
            "SELECT u.userId 
            FROM HomeBundle:Follow f 
            JOIN HomeBundle:User u 
            WITH f.followInfluencer = u.userId 
            WHERE u.userId = '$userId'"
        );
        $followers_v = $followers->getResult();

        $amountFollowers = 0;
        while (isset($followers_v[$amountFollowers]['userId'])) {
            $amountFollowers++; // 
        }
        return $amountFollowers;
    }
    
    public function get_amountInfluencers($userId, $em)
    {
        $influencers = $em->createQuery(                    
            "SELECT u.userId 
            FROM HomeBundle:Follow f 
            JOIN HomeBundle:User u 
            WITH f.followFollower = u.userId 
            WHERE u.userId = '$userId'"
        );
        $influencers_v = $influencers->getResult();

        $amountInfluencers = 0;
        while (isset($influencers_v[$amountInfluencers]['userId'])) {
            $amountInfluencers++; // 
        }
        return $amountInfluencers;
    }
    
    public function get_amountVideos($userId, $em)
    {
        $videos = $em->createQuery(
            "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
            v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
            v.videoAmountComments, v.videoLikes, v.videoDislikes 
            FROM HomeBundle:Video v 
            JOIN HomeBundle:User u 
            WITH v.user = u.userId 
            WHERE u.userId = '$userId'"
        );
        $videos_v = $videos->getResult();

        $amountVideos = 0;
        while (isset($videos_v[$amountVideos]['videoId'])) {
            $amountVideos++; // this is a link to show the videos that belong to the user
        }
        return $amountVideos;
            
    }
    
    public function get_amountSpecificLists($userId, $em)
    {
        $specific_list = $em->createQuery(
            "SELECT sl.specificlistId, sl.specificlistName 
            FROM HomeBundle:Specificlist sl 
            JOIN HomeBundle:User u 
            WITH sl.user = u.userId 
            WHERE u.userId = '$userId'"
        );
        $specific_list_v = $specific_list->getResult();

        $amountSpecificLists = 0;
        while (isset($specific_list_v[$amountSpecificLists]['specificlistId'])) {
            $amountSpecificLists++; // this is another function, and another div 
        }

        return $amountSpecificLists;
    }
    
    
    
    
    
    
    

    public function logInUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $user_name = $_POST['user_name'];
        $user_password = $_POST["user_password"];

        $geolocalization33 = $_SERVER["REMOTE_ADDR"];

        if ($request->isXMLHttpRequest()) {

            $user = $em->createQuery(
                "SELECT u.userId, u.userName 
                FROM HomeBundle:User u 
                WHERE u.userName = '$user_name' and u.userPassword = '$user_password'"
            );

            $users = $user->getResult();

            if (!$users) {
//                vacio
                $users2 = array();
                $users2[] = array(
                    'id' => "0",
                    'userName' => "0"
                );
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            } else {
//                lleno    
//                insertar login de sesion 
                $_SESSION['loginSession'] = $users[0]['userId'];

                $userId22 = $_SESSION['loginSession'];
                $userId = "start";

                $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId22);

                $login = new \HomeBundle\Entity\Login;

                $login->setLoginGeolocalization($geolocalization33);
                $login->setLoginHour("123");
                $login->setUser($user);

                $em->persist($login);
                $em->flush();
                
                $users2 = array();
                $users2[] = array(
                    'id' => $users[0]['userId'],
                    'userName' => $users[0]['userName'],
                    'prueba123' => $userId
                );
                
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            }
        }
    }

    public function logOutUserAction(Request $request) {
        
        session_unset();
        session_destroy();
        $geolocalization33 = $_SERVER["REMOTE_ADDR"];
        if ($request->isXMLHttpRequest()) {

            $users2 = array();
            $users2[] = array(
                'id' => $geolocalization33,
                'userName' => $geolocalization33
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function reLogInAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $user_name = $_POST['user_name'];
        $user_password = $_POST["user_password"];
        
        $geolocalization33 = $_SERVER["REMOTE_ADDR"];
        if ($request->isXMLHttpRequest()) {
            $user = $em->createQuery(
                "SELECT u.userId, u.userName 
                FROM HomeBundle:User u 
                WHERE u.userName = '$user_name' and u.userPassword = '$user_password'"
            );
            $users = $user->getResult();
            if (!$users) {
//                vacio
                $users2 = array();
                $users2[] = array(
                    'id' => "0",
                    'userName' => "0"
                );
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            } else {
//                lleno    
//                insertar login de sesion 
                
                session_start();
                
                $_SESSION['loginSession'] = $users[0]['userId'];
                $userId22 = $_SESSION['loginSession'];
                $userId = "start";
                $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId22);
                $login = new \HomeBundle\Entity\Login;
                $login->setLoginGeolocalization($geolocalization33);
                $login->setLoginHour("123");
                $login->setUser($user);
                $em->persist($login);
                $em->flush();
                
                $users2 = array();
                $users2[] = array(
                    'id' => $users[0]['userId'],
                    'userName' => $users[0]['userName'],
                    'prueba123' => $userId
                );
                
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            }
        }
    }
    
    
    
    
    
    
    public function signUpAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $user_name = $_POST['user_name_signUp'];
            $user_firstGivenName = $_POST['user_firstGivenName'];
            $user_secondGivenName = $_POST['user_secondGivenName'];
            $user_firstFamilyName = $_POST['user_firstFamilyName'];
            $user_secondFamilyName = $_POST['user_secondFamilyName'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password_signUp'];
            $user_biography = $_POST['user_biography'];
            $user_city = $_POST['user_city'];
            $user_profilePhoto = $_FILES['user_profilePhoto']['name'];

            $city = $em->getRepository('HomeBundle:City')->findOneByCityName($user_city);
            
            $user = new \HomeBundle\Entity\User;
            $user->setUserProfilephoto($user_profilePhoto);
            $user->setUserName($user_name);
            $user->setUserFirstgivenname($user_firstGivenName);
            $user->setUserSecondgivenname($user_secondGivenName);
            $user->setUserFirstfamilyname($user_firstFamilyName);
            $user->setUserSecondfamilyname($user_secondFamilyName);
            $user->setUserEmail($user_email);
            $user->setUserPassword($user_password);
            $user->setUserBiography($user_biography);
            $user->setCity($city);
            

            $em->persist($user);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'userId' => $user->getUserId(),
                'userProfilephoto' => $user->getUserProfilephoto(),
                'userName' => $user->getUserName(),
                'userFirstgivenname' => $user->getUserFirstgivenname(),
                'userSecondgivenname' => $user->getUserSecondgivenname(),
                'userFirstfamilyname' => $user->getUserFirstfamilyname(),
                'userSecondfamilyname' => $user->getUserSecondfamilyname(),
                'userEmail' => $user->getUserEmail(),
                'userPassword' => $user->getUserPassword(),
                'userBiography' => $user->getUserBiography(),
                'city' => $user->getCity()
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getCountryAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $country = $em->createQuery(
                "SELECT c.countryId, c.countryName 
                FROM HomeBundle:Country c "
            );
            $country_v = $country->getResult();
            
            $amountCountries = 0;
            while (isset($country_v[$amountCountries]['countryId'])) {
                $amountCountries++; // this is another function, and another div 
            }
            
            $i = 0;
            while (isset($country_v[$i]['countryId'])) {
                
                if ($country_v) {
                    $countryId_Value = $country_v[$i]['countryId'];
                    $countryName_Value = $country_v[$i]['countryName'];
                    $amountCountries_Value = $amountCountries;
                } else {
                    $countryId_Value = "_";
                    $countryName_Value = "_";
                    $amountCountries_Value = $amountCountries;
                }

                $countryData[$i] = array(
                    'countryId' => $countryId_Value,
                    'countryName' => $countryName_Value,
                    'amountCountries' => $amountCountries_Value
                );
                $i++;
            }
            
            return new Response(json_encode($countryData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getCityAction(Request $request)
    {
        
        $user_country = $_POST['user_country'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $city = $em->createQuery(
                "SELECT ci.cityId, ci.cityName 
                FROM HomeBundle:City ci 
                JOIN HomeBundle:Country co 
                WITH ci.country = co.countryId 
                WHERE co.countryName = '$user_country'"
            );
            $city_v = $city->getResult();
            
            $amountCities = 0;
            while (isset($city_v[$amountCities]['cityId'])) {
                $amountCities++; // this is another function, and another div 
            }
            
            $i = 0;
            while (isset($city_v[$i]['cityId'])) {
                
                if ($city_v) {
                    $cityId_Value = $city_v[$i]['cityId'];
                    $cityName_Value = $city_v[$i]['cityName'];
                    $amountCities_Value = $amountCities;
                } else {
                    $cityId_Value = "_";
                    $cityName_Value = "_";
                    $amountCities_Value = $amountCities;
                }

                $cityData[$i] = array(
                    'cityId' => $cityId_Value,
                    'cityName' => $cityName_Value,
                    'amountCities' => $amountCities_Value
                );
                $i++;
            }
            
            return new Response(json_encode($cityData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function uploadProfilePhotoAction(Request $request)
    {
        $carpeta = "files/profilePhotos/";
        opendir($carpeta);
        
        $filenameImage = $_FILES['user_profilePhoto']['tmp_name'];
        $destinationImage = $carpeta . $_FILES['user_profilePhoto']['name'];
        $typeImage = $_FILES['user_profilePhoto']['type'];
        
        if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
            move_uploaded_file($filenameImage, $destinationImage);
        } else {
            //            $product_image = "xxx";
            //            ejecutar una acción que le diga al usuario que no se pudo subir la imagen
        }
        
        $response = array();
        $response[] = array(
            'variable' => "_"
        );
        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }
    
}