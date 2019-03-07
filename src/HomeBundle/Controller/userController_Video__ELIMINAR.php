<?php

namespace EMM\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use EMM\UserBundle\Entity\User;
use EMM\UserBundle\Form\UserType;

class UserController extends Controller
{
    public function homeAction()
    {
        return $this->render('EMMUserBundle:User:home.html.twig');
    }
    
    public function indexAction(Request $request) 
    {
        $searchQuery = $request->get('query');
        
        if(!empty($searchQuery))
        {
            $finder = $this->container->get('fos_elastica.finder.app.user');
            $users = $finder->createPaginatorAdapter($searchQuery);
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            $dql = "SELECT u FROM EMMUserBundle:User u ORDER BY u.id DESC";
            $users = $em->createQuery($dql);            
        }
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users, $request->query->getInt('page', 1),
            10
        );
        
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'emm_user_delete');
        
        return $this->render('EMMUserBundle:User:index.html.twig', 
                array('pagination' => $pagination, 
                    'delete_form_ajax' => $deleteFormAjax->createView()));
    }
    
    public function viewAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('EMMUserBundle:User');
        
        $user = $repository->find($id);
        
        if(!$user)
        {
            $messageException = $this->get('translator')->trans('User not found.');
            throw $this->createNotFoundException($messageException);
        }
        
        $deleteForm = $this->createCustomForm($user->getId(), 'DELETE', 'emm_user_delete');
        
        return $this->render('EMMUserBundle:User:view.html.twig', 
                array('user' => $user, 
                    'delete_form' => $deleteForm->createView()));
    }
    
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('EMMUserBundle:User')->find($id);
        
        if(!$user)
        {
            $messageException = $this->get('translator')->trans('User not found.');
            throw $this->createNotFoundException($messageException);
        }
        
        $allUsers = $em->getRepository('EMMUserBundle:User')->findAll();
        $countUsers = count($allUsers);
        
        // $form = $this->createDeleteForm($user);
        $form = $this->createCustomForm($user->getId(), 'DELETE', 'emm_user_delete');
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            if($request->isXMLHttpRequest())
            {
                $res = $this->deleteUser($user->getRole(), $em, $user);
                
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'], 'countUsers' => $countUsers)),
                    200,
                    array('Content-Type' => 'application/json')
                );
            }
            
            $res = $this->deleteUser($user->getRole(), $em, $user);
            $this->addFlash($res['alert'], $res['message']);
            return $this->redirectToRoute('emm_user_index');
        }
    }
    
    private function deleteUser($role, $em, $user) 
    {
        if($role == 'ROLE_USER')
        {
            $em->remove($user);
            $em->flush();
            
            $message = $this->get('translator')->trans('The user has been deleted.');
            $removed = 1;
            $alert = 'mensaje';
        }
        elseif($role == 'ROLE_ADMIN')
        {
            $message = $this->get('translator')->trans('The user could not be deleted.');
            $removed = 0;
            $alert = 'error';
        }
        
        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }
    
    private function createCustomForm($id, $method, $route) 
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
    }
}