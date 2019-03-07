<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class g_SearchEngineController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/g_SearchEngine/index.html.twig');
    }
}