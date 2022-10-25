<?php

namespace App\Controller;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     * @Route("/")
     */
    public function home(EntityManagerInterface $manager,UserPasswordHasherInterface $hasher): Response
    {

        return $this->render('home/home.html.twig');
    }    
    /**  
     * @Route("/profile",name="profile")
     */ 
    public function profile()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();
        if(in_array('ROLE_ADMIN',$user->getRoles()))
        {
            return $this->redirectToRoute('admin');
        }
        if(in_array('ROLE_STUDENT',$user->getRoles()))
        {
            return $this->redirectToRoute('studentProfile');
        }
        if(in_array('ROLE_TEACHER',$user->getRoles()))
        {
            return $this->redirectToRoute('teacherprofile');
        }

        return $this->render('home/home.html.twig');
    }    
}

