<?php

namespace VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('@Video/Default/index.html.twig');
    }

    
    function readLyricsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $idVideo = $_POST['idVideo'];

        if ($request->isXMLHttpRequest()) {

            $lyricsLine = $em->createQuery(
                "SELECT ll.lyricslineId, lw.lyricswordId, lw.lyricswordStarttime, lw.lyricswordEndtime, v.videoId 
                FROM HomeBundle:Lyricsline ll 
                JOIN HomeBundle:Video v 
                WITH ll.video = v.videoId 
                JOIN HomeBundle:Lyricsword lw 
                WITH lw.lyricsline = ll.lyricslineId 
                WHERE ll.video = '$idVideo'"
            );
            
            $lyrics = $lyricsLine->getResult();
            
            $amountLines = 0;
            while (isset($lyrics[$amountLines]['lyricslineId'])) {
                $amountLines++;
            }
            
            $i = 0;
            while (isset($lyrics[$i]['lyricslineId'])) {

                if ($lyrics) {
                    $lyricslineId_Value = $lyrics[$i]['lyricslineId'];
                    $lyricswordId_Value = $lyrics[$i]['lyricswordId'];
                    $lyricswordStarttime_Value = $lyrics[$i]['lyricswordStarttime'];
                    $lyricswordEndtime_Value = $lyrics[$i]['lyricswordEndtime'];
                    $videoId_Value = $lyrics[$i]['videoId'];
                    $amountLines_Value = $amountLines;
                } else {
                    $lyricslineId_Value = "_";
                    $lyricswordId_Value = "_";
                    $lyricswordStarttime_Value = "_";
                    $lyricswordEndtime_Value = "_";
                    $videoId_Value = "_";
                    $amountLines_Value = $amountLines;
                }

                $sendData[$i] = array(
                    'lyricslineId' => $lyricslineId_Value,
                    'lyricswordId' => $lyricswordId_Value,
                    'lyricswordStarttime' => $lyricswordStarttime_Value,
                    'lyricswordEndtime' => $lyricswordEndtime_Value,
                    'videoId' => $videoId_Value,
                    'amountLines' => $amountLines_Value
                );
                $i++;
            }
            
            if (isset($lyrics[0]['lyricslineId'])) {
                
            } else
            {
                $sendData[0] = array(
                    'lyricslineId' => "-",
                    'lyricswordId' => "-",
                    'lyricswordStarttime' => "-",
                    'lyricswordEndtime' => "-",
                    'videoId' => "-",
                    'amountLines' => 0
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    function getClosedCaptionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $idVideo = $_POST['idVideo'];
        
        if ($request->isXMLHttpRequest()) {

            $lyricsLine = $em->createQuery(
                "SELECT ll.lyricslineId, lw.lyricswordId, lw.lyricswordStarttime, lw.lyricswordEndtime, v.videoId 
                FROM HomeBundle:Lyricsline ll 
                JOIN HomeBundle:Video v 
                WITH ll.video = v.videoId 
                JOIN HomeBundle:Lyricsword lw 
                WITH lw.lyricsline = ll.lyricslineId 
                WHERE ll.video = '$idVideo'"
            );
            
            $lyrics = $lyricsLine->getResult();
            
            $amountLines = 0;
            while (isset($lyrics[$amountLines]['lyricslineId'])) {
                $amountLines++;
            }
            
            $i = 0;
            while (isset($lyrics[$i]['lyricslineId'])) {

                if ($lyrics) {
                    $lyricslineId_Value = $lyrics[$i]['lyricslineId'];
                    $lyricswordId_Value = $lyrics[$i]['lyricswordId'];
                    $lyricswordStarttime_Value = $lyrics[$i]['lyricswordStarttime'];
                    $lyricswordEndtime_Value = $lyrics[$i]['lyricswordEndtime'];
                    $videoId_Value = $lyrics[$i]['videoId'];
                    $amountLines_Value = $amountLines;
                } else {
                    $lyricslineId_Value = "_";
                    $lyricswordId_Value = "_";
                    $lyricswordStarttime_Value = "_";
                    $lyricswordEndtime_Value = "_";
                    $videoId_Value = "_";
                    $amountLines_Value = $amountLines;
                }

                $sendData[$i] = array(
                    'lyricslineId' => $lyricslineId_Value,
                    'lyricswordId' => $lyricswordId_Value,
                    'lyricswordStarttime' => $lyricswordStarttime_Value,
                    'lyricswordEndtime' => $lyricswordEndtime_Value,
                    'videoId' => $videoId_Value,
                    'amountLines' => $amountLines_Value
                );
                $i++;
            }
            
            if (isset($lyrics[0]['lyricslineId'])) {
                
            } else
            {
                $sendData[0] = array(
                    'lyricslineId' => "-",
                    'lyricswordId' => "-",
                    'lyricswordStarttime' => "-",
                    'lyricswordEndtime' => "-",
                    'videoId' => "-",
                    'amountLines' => 0
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    
    
    function setClosedCaptionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $closeCaptionContent = $_POST['closeCaptionContent'];
        
//        first at all, we need to introduce these variables
        
        $lyricsline = $em->getRepository('HomeBundle:Lyricsline')->findOneByLyricslineId(1);
        
        $lyricsWord = new \HomeBundle\Entity\Lyricsword;
        $lyricsWord->setLyricswordContent($closeCaptionContent);
        $lyricsWord->setLyricswordStarttime($startTime);
        $lyricsWord->setLyricswordEndtime($endTime);
        $lyricsWord->setLyricsline($lyricsline);
        $em->persist($lyricsWord);
        $em->flush();

        if ($request->isXMLHttpRequest()) {
            
            $lyricswordId_value = $lyricsWord->getLyricswordId();
            $lyricsline_value = $lyricsWord->getLyricsline();
            $lyricswordContent_value = $lyricsWord->getLyricswordContent();
            $lyricswordEndtime_value = $lyricsWord->getLyricswordEndtime();
            $lyricswordStarttime_value = $lyricsWord->getLyricswordStarttime();

            $sendData[0] = array(
                'lyricswordId' => $lyricswordId_value,
                'lyricsline' => $lyricsline_value,
                'lyricswordContent' => $lyricswordContent_value,
                'lyricswordEndtime' => $lyricswordEndtime_value,
                'lyricswordStarttime' => $lyricswordStarttime_value
            );
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    function deleteSpecificClosedCaptionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $lyricswordId = $_POST['lyricswordId'];

        if ($request->isXMLHttpRequest()) {

        $lyricsword = $em->getRepository('HomeBundle:Lyricsword')->findOneByLyricswordId($lyricswordId);
        $em->remove($lyricsword);
        $em->flush();
        
        $sendData[0] = array(
            '_' => "_"
        );
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
}
