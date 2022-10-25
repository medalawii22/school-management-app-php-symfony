<?php

namespace App\Controller;

use App\Repository\ElementRepository;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/** 
 * @Route("/student")
 * 
 * @IsGranted("ROLE_STUDENT")
*/

class StudentController extends AbstractController
{
    /**
     * @Route("/profile",name="studentProfile")
     */
    public function profile()
    {
        return $this->render("student/profile.html.twig",
    [
        "user"=>$this->getUser()
    ]);
    }
    /**
     * @Route("Info/scolaires",name="studentscholarinfo")
     */
    public function scholarInfo()
    {
        return $this->render("student/studentscholarinfo.html.twig",[
            "user"=>$this->getUser()
        ]);
    } 
    /**
     * @Route("/inscription",name="inscription")
     */
    public function inscription(ModuleRepository $repo)
    {
        $UserClass=$this->getUser()->getClasse();
        
    
        return $this->render("student/inscription.html.twig",[
            "user"=>$this->getUser()
        ]);
    } 
    /**
     * @Route("/notes",name="studentnotes")
     */
    public function studentNotes()
    {
        $user=$this->getUser();

        return $this->render("student/studentNotes.html.twig",[
            "user"=>$user
        ]);
    }
}
