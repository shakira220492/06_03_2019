<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class d_PremiumController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/d_Premium/index.html.twig');
    }
    
}
