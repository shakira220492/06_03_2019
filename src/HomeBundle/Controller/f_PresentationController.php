<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class f_PresentationController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/f_Presentation/index.html.twig');
    }

    public function addSugerencesCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/addSugerencesCurrentVideo/index.html.twig');
    }

    public function announcesAction()
    {
        return $this->render('@Home/f_Presentation/announces/index.html.twig');
    }

    public function changeScreenShotCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/changeScreenShotCurrentVideo/index.html.twig');
    }

    public function changeTimePositionCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/changeTimePositionCurrentVideo/index.html.twig');
    }

    public function deleteCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/deleteCurrentVideo/index.html.twig');
    }

    public function editDescriptionCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/editDescriptionCurrentVideo/index.html.twig');
    }

    public function editKeywordsCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/editKeywordsCurrentVideo/index.html.twig');
    }

    public function editLyricsCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/editLyricsCurrentVideo/index.html.twig');
    }

    public function editNameCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/editNameCurrentVideo/index.html.twig');
    }

    public function goBackCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/goBackCurrentVideo/index.html.twig');
    }
    
    public function helpAction()
    {
        return $this->render('@Home/f_Presentation/help/index.html.twig');
    }
    
    public function informationCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/informationCurrentVideo/index.html.twig');
    }
    
    public function lyricsCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/lyricsCurrentVideo/index.html.twig');
    }
    
    public function playPauseCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/playPauseCurrentVideo/index.html.twig');
    }
    
    public function preVisualizationCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/preVisualizationCurrentVideo/index.html.twig');
    }
    
    public function premiumSubcriptionAction()
    {
        return $this->render('@Home/f_Presentation/premiumSubcription/index.html.twig');
    }
    
    public function qualityCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/qualityCurrentVideo/index.html.twig');
    }
    
    public function selectListToCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/selectListToCurrentVideo/index.html.twig');
    }
    
    public function shareCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/shareCurrentVideo/index.html.twig');
    }
    
    public function shoppingCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/shoppingCurrentVideo/index.html.twig');
    }
    
    public function showHideOptionsAction()
    {
        return $this->render('@Home/f_Presentation/showHideOptions/index.html.twig');
    }
    
    public function speedCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/speedCurrentVideo/index.html.twig');
    }
    
    public function tonalitiesCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/tonalitiesCurrentVideo/index.html.twig');
    }
    
    public function wirelessCurrentVideoAction()
    {
        return $this->render('@Home/f_Presentation/wirelessCurrentVideo/index.html.twig');
    }
}
