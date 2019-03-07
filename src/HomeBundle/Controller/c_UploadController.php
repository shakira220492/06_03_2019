<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class c_UploadController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/c_Upload/index.html.twig');
    }
    
//    there will be next options:
//    newsfeed - upload images, news, photos
//    login - logout
    
}
