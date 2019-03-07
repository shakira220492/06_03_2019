<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class e_AdvertisingController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/e_Advertising/index.html.twig');
    }
    
//    there will be next options:
//    offer the user the alternative to put customize announces
    
}
        