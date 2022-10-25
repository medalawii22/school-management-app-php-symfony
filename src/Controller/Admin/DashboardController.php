<?php

namespace App\Controller\Admin;

use App\Repository\FiliereRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Teacher;
use App\Entity\TypeProf;
use App\Entity\Filiere;
use App\Entity\Semestre;
use App\Entity\Niveau;
use App\Entity\Notes;
use App\Entity\Module;
use App\Entity\Student;
use App\Entity\Classe;
use App\Entity\Element;

class DashboardController extends AbstractDashboardController
{
    private $studentrepository;
    private $teacherrepository;
    private $filiererepository;
    public function __construct(StudentRepository $studentrepo,TeacherRepository $teacherrepo,FiliereRepository $filiererepo)
    {
        $this->studentrepository=$studentrepo;
        $this->teacherrepository=$teacherrepo;
        $this->filiererepository=$filiererepo;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render("bundles/EasyAdminBundle/welcome.html.twig",[
            "students"=>$this->studentrepository->findAll(),
            "teachers"=>$this->teacherrepository->findAll(),
            "filieres"=>$this->filiererepository->findAll()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SchoolApp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('teachers','fas fa-chalkboard-teacher',Teacher::class);
        yield MenuItem::linkToCrud('type de profs','fa ',TypeProf::class);
        yield MenuItem::linkToCrud('Filieres','fa fa-home',Filiere::class);
        yield MenuItem::linkToCrud('niveaux','fa fa-home',Niveau::class);
        yield MenuItem::linkToCrud('notes','fas fa-marker',Notes::class);
        yield MenuItem::linkToCrud('module','fa fa-person',Module::class);
        yield MenuItem::linkToCrud('element','fas fa-book-open',Element::class);
        yield MenuItem::linkToCrud('classe','fas fa-school',Classe::class);
        yield MenuItem::linkToCrud('students',"fas fa-graduation-cap",Student::class);
       
       
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
