<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Notes;
use App\Model\Changepass;
use App\Entity\Teacher;
use App\Form\ChangepassType;
use App\Form\SetNoteType;
use App\Form\teacherType;
use App\Model\SetNote;
use App\Repository\ElementRepository;
use App\Repository\NotesRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/teacher")
 * @IsGranted("ROLE_TEACHER")
 */
class TeacherController extends AbstractController
{
    /**
     * @Route("/home", name="teacherprofile") 
     */
    public function index(): Response
    {
        return $this->render('teacher/profile.html.twig');
    }
    /**
     * @Route("/elements",name="teacherelements")
     */
    public function elements(StudentRepository $repo)
    {
        $myElements=$this->getUser()->getElements();
        #this is an array wich contain each elements with the student suscribed

        $array=[];

        foreach($myElements as $element)
        {
            $class=$element->getModule()->getClasse();
            array_push($array,["element"=>$element,"class"=>$class]);
        }
        return $this->render('teacher/elements.html.twig',[
            "array"=>$array
        ]);
    }

    /**
     * @Route("/settings",name="teacherSettings")
     */
    public function settings(Request  $request)
    {
        $changepass=new Changepass();
        $form=$this->createForm(ChangepassType::class,$changepass);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            
        }
        return $this->render("teacher/teacherSettings.html.twig",[
            'form'=>$form->createView()
        ]);
    }
    #this controller contains the names of student so that the teacher can give them marks

    /**
     * @Route("/students",name="teacherstudents")
     */
    public function students(Request $request,StudentRepository $repo,NotesRepository $nrepo,
    PaginatorInterface $paginator)
    {
        $teacher=$this->getUser();
        $elements=$teacher->getElements();
        $array=[];
        foreach($elements as $element)
        {
            $info=[];

            $students=$element->getModule()->getClasse()->getStudents();
            foreach($students as $student)
            {
                $noteElement=$nrepo->findByStudentElement($student,$element);
                array_push($info,["student"=>$student,"noteElement"=>$noteElement]);
            }
            array_push($array,['element'=>$element,"info"=>$info]);
        }
        
        $array=$paginator
        ->paginate(
            $array,
            $request->query->getInt("page",1),1
        );
        
        return $this->render("teacher/students.html.twig",[
            "array"=>$array,"students"=>$students
        ]);
    }
    #this controller contains a form for giving marks
    /**
     * @Route("donner-une-note/{studentId}{elementId}",name="setNote")
     */
    public function setNote($studentId,$elementId,Request $request,StudentRepository $repo,
    ElementRepository $erepo,EntityManagerInterface $manager,NotesRepository $nrepo)
    {
        $student=$repo->findById($studentId);
        $element=$erepo->findById($elementId);
        $note=$nrepo->findByStudentElement($student,$element);
        $setNotee =new setNote();
        if(!$note)
        {
            $note=new Notes();
        } else{
            $setNotee->setNote($note->getValue());
        }
        $form=$this->createForm(SetNoteType::class,$setNotee);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isvalid())
        {
            $note->setValue($setNotee->getNote())
                 ->setElement($element)
                 ->setStudent($student)
            ;
            $manager->persist($note);
            $manager->flush();
            return $this->redirectToRoute("teacherstudents");
        }
        return $this->render("teacher/setNote.html.twig",
    [
        "form"=>$form->createView(),
        "student"=>$student
    ]);
    }
}