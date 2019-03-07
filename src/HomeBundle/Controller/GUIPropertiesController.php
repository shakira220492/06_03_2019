<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GUIPropertiesController extends Controller {

    public function GUIPropertiesAction() {
        return $this->render('@Home/home/form/GUIProperties.html.twig');
    }

    public function getStoredFieldAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

//        fieldName

        
        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($sessionId);

        if ($sessionId == "logOut")
        {
            $selectedField = $em->createQuery(
                "SELECT f.fieldId, f.fieldName, f.fieldUsualmode, f.fieldCurrentmode 
                FROM HomeBundle:Field f"
            );
        } else
        {
            $selectedField = $em->createQuery(
                "SELECT f.fieldId, f.fieldName, f.fieldUsualmode, f.fieldCurrentmode, u.userId, l.layoutId 
                FROM HomeBundle:Field f 
                JOIN HomeBundle:User u 
                WITH u.userId = f.user 
                JOIN HomeBundle:Layout l 
                WITH l.layoutId = f.layout 
                WHERE u.userId = '$sessionId' and f.fieldName = '$fieldName'"
            );
        }
            

            $selectedFieldInstance = $selectedField->getResult();

            if ($selectedFieldInstance) {
                $selectedFieldId_Value = $selectedFieldInstance[0]['fieldId'];
                $selectedFieldName_Value = $selectedFieldInstance[0]['fieldName'];
                $selectedFieldUsualmode_Value = $selectedFieldInstance[0]['fieldUsualmode'];
                $selectedFieldCurrentmode_Value = $selectedFieldInstance[0]['fieldCurrentmode'];
            } else {
                $selectedFieldId_Value = "_";
                $selectedFieldName_Value = "_";
                $selectedFieldUsualmode_Value = "_";
                $selectedFieldCurrentmode_Value = "_";
            }

            
        if ($sessionId == "logOut")
        {
            $permanentField = $em->createQuery(
                "SELECT f.fieldId, f.fieldName, f.fieldUsualmode, f.fieldCurrentmode 
                FROM HomeBundle:Field f 
                WHERE f.fieldUsualmode = 'permanent'"
            );
        } else
        {
            $permanentField = $em->createQuery(
                "SELECT f.fieldId, f.fieldName, f.fieldUsualmode, f.fieldCurrentmode, u.userId, l.layoutId 
                FROM HomeBundle:Field f 
                JOIN HomeBundle:User u 
                WITH u.userId = f.user 
                JOIN HomeBundle:Layout l 
                WITH l.layoutId = f.layout 
                WHERE u.userId = '$sessionId' and f.fieldUsualmode = 'permanent'"
            );
        }
        
            $permanentFieldInstance = $permanentField->getResult();

            if ($permanentFieldInstance) {
                $permanentFieldId_Value = $permanentFieldInstance[0]['fieldId'];
                $permanentFieldName_Value = $permanentFieldInstance[0]['fieldName'];
                $permanentFieldUsualmode_Value = $permanentFieldInstance[0]['fieldUsualmode'];
                $permanentFieldCurrentmode_Value = $permanentFieldInstance[0]['fieldCurrentmode'];
            } else {
                $permanentFieldId_Value = "_";
                $permanentFieldName_Value = "_";
                $permanentFieldUsualmode_Value = "_";
                $permanentFieldCurrentmode_Value = "_";
            }
            
            $selectedLayoutId_Value = "";
            $permanentLayoutId_Value = "";

            $sendData[0] = array(
                'selectedFieldId' => $selectedFieldId_Value,
                'selectedFieldName' => $selectedFieldName_Value,
                'selectedFieldUsualmode' => $selectedFieldUsualmode_Value,
                'selectedFieldCurrentmode' => $selectedFieldCurrentmode_Value,
                'selectedLayoutId_Value' => $selectedLayoutId_Value,
                'permanentFieldId' => $permanentFieldId_Value,
                'permanentFieldName' => $permanentFieldName_Value,
                'permanentFieldUsualmode' => $permanentFieldUsualmode_Value,
                'permanentFieldCurrentmode' => $permanentFieldCurrentmode_Value,
                'permanentLayoutId' => $permanentLayoutId_Value
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function getStoredLayoutAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

//        fieldName

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($sessionId);

            $layout = $em->createQuery(
                    "SELECT l.layoutId, l.layoutBackgroundcolor, l.layoutOpacity, l.layoutWidth, l.layoutHeight, u.userId 
                FROM HomeBundle:Layout l 
                JOIN HomeBundle:User u 
                WITH u.userId = l.user 
                JOIN HomeBundle:Field f 
                WITH l.layoutId = f.layout 
                WHERE u.userId = '$sessionId' and f.fieldName = '$fieldName'"
            );


            $layouts = $layout->getResult();

            if ($layouts) {
                $layoutId_Value = $layouts[0]['layoutId'];
                $layoutBackgroundcolor_Value = $layouts[0]['layoutBackgroundcolor'];
                $layoutOpacity_Value = $layouts[0]['layoutOpacity'];
                $layoutWidth_Value = $layouts[0]['layoutWidth'];
                $layoutHeight_Value = $layouts[0]['layoutHeight'];
            } else {
                $layoutId_Value = "_";
                $layoutBackgroundcolor_Value = "_";
                $layoutOpacity_Value = "_";
                $layoutWidth_Value = "_";
                $layoutHeight_Value = "_";
            }

            $sendData[0] = array(
                'layoutId' => $layoutId_Value,
                'layoutBackgroundcolor' => $layoutBackgroundcolor_Value,
                'layoutOpacity' => $layoutOpacity_Value,
                'layoutWidth' => $layoutWidth_Value,
                'layoutHeight' => $layoutHeight_Value,
                'fieldName' => $fieldName,
                'userId' => $sessionId
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function setThisFieldAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($sessionId);
            
            $layout = $em->getRepository('HomeBundle:Layout')->findOneByLayoutId(22);
            if (!$layout) {
//                SET LAYOUT
                $layout = new \HomeBundle\Entity\Layout();
                $layout->setLayoutBackgroundcolor("123");
                $layout->setLayoutHeight("123");
                $layout->setLayoutOpacity("123");
                $layout->setLayoutWidth("123");
                $layout->setUser($user);

                $em->persist($layout);
                $em->flush();
            }

            $fieldFound = $em->getRepository('HomeBundle:Field')->findOneByFieldName($fieldName);
            if ($fieldFound) {
//                $fieldFound->setFieldUsualmode("permanent");
//                $fieldFound->setFieldCurrentmode("selected");
//                $em->flush();
            } else {
                $field = new \HomeBundle\Entity\Field();
                $field->setFieldIcon($fieldName);
                $field->setFieldName($fieldName);
                $field->setFieldUsualmode("permanent");
                $field->setFieldCurrentmode("selected");
                $field->setFieldEmergentwindow("12345");
                $field->setFieldContentwindow("22222");
                $field->setLayout($layout);
                $field->setUser($user);

                $em->persist($field);
                $em->flush();
            }

            $sendData[0] = array(
                'fieldId' => "22",
                'fieldName' => "22",
                'fieldUsualmode' => "22",
                'fieldCurrentmode' => "22",
                'userId' => "22"
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function setThisLayoutAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

//        fieldName

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($sessionId);

//                SET LAYOUT
            $layout = new \HomeBundle\Entity\Layout();
            $layout->setLayoutBackgroundcolor("246");
            $layout->setLayoutHeight("246");
            $layout->setLayoutOpacity("246");
            $layout->setLayoutWidth("246");
            $layout->setUser($user);

            $em->persist($layout);
            $em->flush();


            $sendData[0] = array(
//                'fieldId' => $fieldId_Value,
//                'fieldName' => $fieldName_Value
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function deleteStoredFieldAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

//        fieldName

        if ($request->isXMLHttpRequest()) {

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($sessionId);

            $layout = $em->getRepository('HomeBundle:Layout')->findOneByLayoutId(22);
            if (!$layout) {
//                SET LAYOUT
                $layout = new \HomeBundle\Entity\Layout();
                $layout->setLayoutBackgroundcolor("123");
                $layout->setLayoutHeight("123");
                $layout->setLayoutOpacity("123");
                $layout->setLayoutWidth("123");
                $layout->setUser($user);

                $em->persist($layout);
                $em->flush();
            }

            $fieldFound = $em->getRepository('HomeBundle:Field')->findOneByFieldName($fieldName);
            if ($fieldFound) {
                $fieldFound->setFieldUsualmode("permanent");
                $fieldFound->setFieldCurrentmode("selected");
                $em->flush();
            } else {
                $field = new \HomeBundle\Entity\Field();
                $field->setFieldIcon($fieldName);
                $field->setFieldName($fieldName);
                $field->setFieldUsualmode("permanent");
                $field->setFieldCurrentmode("selected");
                $field->setLayout($layout);
                $field->setUser($user);

                $em->persist($field);
                $em->flush();
            }

            $sendData[0] = array(
//                'fieldId' => $fieldId_Value,
//                'fieldName' => $fieldName_Value
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function deleteStoredLayoutAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];


//        fieldName

        if ($request->isXMLHttpRequest()) {


            $sendData[0] = array(
//                'fieldId' => $fieldId_Value,
//                'fieldName' => $fieldName_Value,
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $subFieldName = $_POST['subFieldName'];
        $subFieldValue = $_POST['subFieldValue'];

        if ($request->isXMLHttpRequest()) {

            $subFieldsAmount = 0;
            while (isset($subFieldName[$subFieldsAmount]) and isset($subFieldValue[$subFieldsAmount])) {
                $subFieldsAmount++;
            }

            $subFields = 0;
            while (isset($subFieldName[$subFields]) and isset($subFieldValue[$subFields])) {

                $valor1 = $subFieldName[$subFields];
                $valor2 = $subFieldValue[$subFields];

                $sendData[$subFields] = array(
                    'valor_1' => $valor1,
                    'valor_2' => $valor2,
                    'subFieldsAmount' => $subFieldsAmount
                );

                $subFields++;
            }



            $idUser = $subFieldValue[1];
            $idLayout = $subFieldValue[2];
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($idUser);
            $layout = $em->getRepository('HomeBundle:Layout')->findOneByLayoutId($idLayout);

            $field = new \HomeBundle\Entity\Field();
            $field->setUser($user);
            $field->setLayout($layout);
            $field->setFieldName($subFieldValue[3]);
            $field->setFieldIcon($subFieldValue[5]);
            $field->setFieldUsualmode("temporal");
            $field->setFieldCurrentmode("unselected");

            $em->persist($field);
            $em->flush();

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function setUsualModeAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

        if ($request->isXMLHttpRequest()) {

            $field = $em->createQuery(
                    "SELECT f.fieldId, f.fieldName, f.fieldUsualmode, f.fieldCurrentmode, u.userId 
                FROM HomeBundle:Field f 
                JOIN HomeBundle:User u 
                WITH u.userId = f.user  
                WHERE u.userId = '$sessionId'"
            );

            $fields = $field->getResult();

            $amountFields = 0;

            $fieldFound211 = $em->getRepository('HomeBundle:Field')->findOneByFieldName("artistIconContent");
            $fieldFound211->setFieldUsualmode("zzz");
            $em->flush();

            while (isset($fields[$amountFields]['fieldName'])) {

                $respectlyFieldName = $fields[$amountFields]['fieldName'];

                if ($respectlyFieldName === $fieldName) {

                    $respectlyFieldUsualmode = $fields[$amountFields]['fieldUsualmode'];

                    if ($respectlyFieldUsualmode === 'permanent') {
                        $fieldFound1 = $em->getRepository('HomeBundle:Field')->findOneByFieldName($respectlyFieldName);
                        $fieldFound1->setFieldUsualmode("temporal");
                        $em->flush();
                    }
                    if ($respectlyFieldUsualmode === 'temporal') {
                        $fieldFound3 = $em->getRepository('HomeBundle:Field')->findOneByFieldName($respectlyFieldName);
                        $fieldFound3->setFieldUsualmode("permanent");
                        $em->flush();
                    }
                } else {
                    $fieldFound2 = $em->getRepository('HomeBundle:Field')->findOneByFieldName($respectlyFieldName);
                    $fieldFound2->setFieldUsualmode("temporal");
                    $em->flush();
                }
                $amountFields++;
            }

            if ($fields) {
                $fieldId_Value = $fields[0]['fieldId'];
                $fieldName_Value = $fields[0]['fieldName'];
                $fieldUsualmode_Value = $fields[0]['fieldUsualmode'];
                $fieldCurrentmode_Value = $fields[0]['fieldCurrentmode'];
                $userId_Value = $fields[0]['userId'];
            } else {
                $fieldId_Value = "_";
                $fieldName_Value = "_";
                $fieldUsualmode_Value = "_";
                $fieldCurrentmode_Value = "_";
                $userId_Value = "_";
            }

            $sendData[0] = array(
                'fieldId' => $fieldId_Value,
                'fieldName' => $fieldName_Value,
                'fieldUsualmode' => $fieldUsualmode_Value,
                'fieldCurrentmode' => $fieldCurrentmode_Value,
                'userId' => $userId_Value
            );
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function setCurrentModeAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $sessionId = $_POST['sessionId'];
        $fieldName = $_POST['fieldName'];

        if ($request->isXMLHttpRequest()) {

            $field = $em->createQuery(
                    "SELECT f.fieldId, f.fieldName, f.fieldUsualmode, f.fieldCurrentmode, u.userId 
                FROM HomeBundle:Field f 
                JOIN HomeBundle:User u 
                WITH u.userId = f.user  
                WHERE u.userId = '$sessionId'"
            );

            $fields = $field->getResult();

            $amountFields = 0;
            while (isset($fields[$amountFields]['fieldName'])) {

                $respectlyFieldName = $fields[$amountFields]['fieldName'];

                if ($respectlyFieldName === $fieldName) {
                    $fieldFound1 = $em->getRepository('HomeBundle:Field')->findOneByFieldName($respectlyFieldName);
                    $fieldFound1->setFieldCurrentmode("selected");
                    $em->flush();
                } else {
                    $fieldFound2 = $em->getRepository('HomeBundle:Field')->findOneByFieldName($respectlyFieldName);
                    $fieldFound2->setFieldCurrentmode("unselected");
                    $em->flush();
                }

                $amountFields++;
            }

            $sendData[0] = array(
                'fieldId' => "22",
                'fieldName' => "22",
                'fieldUsualmode' => "22",
                'fieldCurrentmode' => "22",
                'userId' => "22"
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function uploadProductFormAction (Request $request){
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $product_image = $_FILES['product_image']['name'];
        $product_video = $_FILES['product_video']['name'];
        
        $user_id_login22 = $_POST['user_id_login_input'];
        $user_id_login = "1";
        
        $carpeta = "files/";
        opendir($carpeta);
        $filenameImage = $_FILES['product_image']['tmp_name'];
        $destinationImage = $carpeta.$_FILES['product_image']['name'];
        $typeImage = $_FILES['product_image']['type'];
        
        if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png")
        {
            move_uploaded_file($filenameImage, $destinationImage);
        }
        else
        {
            $product_image = "fghj";
//            ejecutar una acción que le diga al usuario que no se pudo subir la imagen
        }
        
        $filenameVideo = $_FILES['product_video']['tmp_name'];
        $destinationVideo = $carpeta.$_FILES['product_video']['name'];
        $typeVideo = $_FILES['product_video']['type'];
        
        if (!$typeVideo == "video/mp4")
        {
            move_uploaded_file($filenameVideo, $destinationVideo);
        }
        else
        {
            $product_video = "yyyy";
//            ejecutar una acción que le diga al usuario que no se pudo subir el video
        }
        
        $em = $this->getDoctrine()->getManager();
        if ($request->isXMLHttpRequest())
        {
            $product = new Product();
            $product->setName($product_name);
            $product->setDescription($product_description);
            $product->setPrice($product_price);
            $product->setImage($product_image);
            $product->setVideo($product_video);
            $product->setAmountViews(1);
            $em->persist($product);
            $em->flush();
            $user = $em->getRepository('BeitechBundle:User')->findOneById($user_id_login);
            $product = $em->getRepository('BeitechBundle_Product')->findOneById($product->getId());
            $availability = new Availability();
            $availability->setIdUser($user);
            $availability->setProduct($product);
            $availability->setStatus("vfvf");
            $em->persist($product);
            $em->flush();
            
            $sendData[0] = array(
                'fieldId' => "22",
                'fieldName' => "22",
                'fieldUsualmode' => "22",
                'fieldCurrentmode' => "22",
                'userId' => "22"
            );

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getWindowPropertiesAction (Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $window = $em->createQuery(
                "SELECT w.windowId, w.windowVideospeed, w.windowGeolocalization, 
                w.windowVolume, w.windowVideosize, w.windowConfigurationareasize, 
                w.windowCurrentvideo, w.windowCurrentlist, w.windowReplay, 
                w.windowThemeconfigurationarea, w.windowThemesessionarea, 
                w.windowThemepresentationarea, w.windowThemecolor, 
                u.userId 

                FROM HomeBundle:Window w 
                JOIN HomeBundle:User u 
                
                WITH u.userId = w.user 
                WHERE u.userId = '$userId'"
            );

            $window_e = $window->getResult();
            
            
            if (isset($window_e[0]['windowId']))
            {
                $windowId_value = $window_e[0]['windowId'];
                $windowVideospeed_value = $window_e[0]['windowVideospeed'];
                $windowGeolocalization_value = $window_e[0]['windowGeolocalization'];
                $windowVolume_value = $window_e[0]['windowVolume'];
                $windowVideosize_value = $window_e[0]['windowVideosize'];
                $windowConfigurationareasize_value = $window_e[0]['windowConfigurationareasize'];
                $windowCurrentvideo_value = $window_e[0]['windowCurrentvideo'];
                $windowCurrentlist_value = $window_e[0]['windowCurrentlist'];
                $windowReplay_value = $window_e[0]['windowReplay'];
                $windowThemeconfigurationarea_value = $window_e[0]['windowThemeconfigurationarea'];
                $windowThemesessionarea_value = $window_e[0]['windowThemesessionarea'];
                $windowThemepresentationarea_value = $window_e[0]['windowThemepresentationarea'];
                $windowThemecolor_value = $window_e[0]['windowThemecolor'];
                $userId_value = $window_e[0]['userId'];

            } else 
            {
                $windowId_value = "_";
                $windowVideospeed_value = "_";
                $windowGeolocalization_value = "_";
                $windowVolume_value = "_";
                $windowVideosize_value = "_";
                $windowConfigurationareasize_value = "_";
                $windowCurrentvideo_value = "_";
                $windowCurrentlist_value = "_";
                $windowReplay_value = "_";
                $windowThemeconfigurationarea_value = "_";
                $windowThemesessionarea_value = "_";
                $windowThemepresentationarea_value = "_";
                $windowThemecolor_value = "_";
                $userId_value = "_";
            }
            
            $window_properties = array();
            $window_properties[0] = array(
                'windowId' => $windowId_value,
                'windowVideospeed' => $windowVideospeed_value,
                'windowGeolocalization' => $windowGeolocalization_value,
                'windowVolume' => $windowVolume_value,
                'windowVideosize' => $windowVideosize_value,
                'windowConfigurationareasize' => $windowConfigurationareasize_value,
                'windowCurrentvideo' => $windowCurrentvideo_value,
                'windowCurrentlist' => $windowCurrentlist_value,
                'windowReplay' => $windowReplay_value,
                'windowThemeconfigurationarea' => $windowThemeconfigurationarea_value,
                'windowThemesessionarea' => $windowThemesessionarea_value,
                'windowThemepresentationarea' => $windowThemepresentationarea_value,
                'windowThemecolor' => $windowThemecolor_value,
                'userId' => $userId_value
            );
            return new Response(json_encode($window_properties), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function setWindowThemeColorAction (Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        $theme = $_POST['theme'];
        
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $windowId = $this->getWindowId_value($em, $userId);
            
            if ($windowId)
            {
                $window = $em->getRepository('HomeBundle:Window')->findOneByWindowId($windowId);
                $window->setWindowThemecolor($theme);

                $em->persist($window);
                $em->flush();

                $windowThemecolor = $window->getWindowThemecolor();
            } else
            {
                $windowThemecolor = "_";
            }
            
            
            $users2 = array();
            $users2[0] = array(
                'windowThemecolor' => $windowThemecolor
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    function getWindowId_value($em, $userId)
    {
        $window = $em->createQuery(
            "SELECT w.windowId 
            FROM HomeBundle:Window w 
            
            JOIN HomeBundle:User u 
            WITH w.user = u.userId 
            
            WHERE u.userId = '$userId'"
        );

        $window_v = $window->getResult();

        if (isset($window_v[0]['windowId'])) {
            $windowId = $window_v[0]['windowId'];
        } else
        {
            $windowId = FALSE;
        }
        return $windowId;
    }
    
}