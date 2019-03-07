<?php

namespace PromoteVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@PromoteVideoBundle/Default/index.html.twig');
    }
}
