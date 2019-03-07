<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class a_ListController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/a_List/index.html.twig');
    }
    
    public function customizeListAction()
    {
        return $this->render('@Home/a_List/customizeList/index.html.twig');
    }
    
    public function listAboutUnknownMusicAction()
    {
        return $this->render('@Home/a_List/listAboutUnknownMusic/index.html.twig');
    }
    
    public function listByCurrentArtistAction()
    {
        return $this->render('@Home/a_List/listByCurrentArtist/index.html.twig');
    }
    
    public function listByCurrentGenreAction()
    {
        return $this->render('@Home/a_List/listByCurrentGenre/index.html.twig');
    }
    
    public function listByDataMiningAction()
    {
        return $this->render('@Home/a_List/listByDataMining/index.html.twig');
    }
    
    public function listByDateAction()
    {
        return $this->render('@Home/a_List/listByDate/index.html.twig');
    }
    
    public function listByTendencyAction()
    {
        return $this->render('@Home/a_List/listByTendency/index.html.twig');
    }
    
}