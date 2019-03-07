<?php

namespace AdvertisingVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@AdvertisingVideo/Default/index.html.twig');
    }
}
