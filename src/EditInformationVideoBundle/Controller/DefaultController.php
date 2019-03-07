<?php

namespace EditInformationVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EditInformationVideoBundle/Default/index.html.twig');
    }
}
