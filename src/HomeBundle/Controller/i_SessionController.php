<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HomeBundle\Entity\Login;

class i_SessionController extends Controller {

    public function indexAction() {
        return $this->render('@Home/home/form/Session.html.twig');
    }
    
}
