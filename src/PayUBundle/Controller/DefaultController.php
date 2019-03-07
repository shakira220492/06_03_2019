<?php

namespace PayUBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@PayU/Default/index.html.twig');
    }
}
