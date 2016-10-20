<?php

namespace AppBundle\Controller;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array());
    }
    
    
     /**
     * @Route("/users/new", name="users_new")
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
        $form= $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();

            /**
             * @var $file UploadedFile
             */
            $fileName = $this->get('app.avatar_upload')->upload($user->getAvatar());
            $user->setAvatar($fileName);
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('homepage');
        }

        // replace this example code with whatever you need
        return $this->render('default/users.html.twig', array('form' => $form->createView()));
    }
    
    
    
    
}
