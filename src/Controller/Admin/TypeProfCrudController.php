<?php

namespace App\Controller\Admin;

use App\Entity\TypeProf;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TypeProfCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeProf::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('typeProf','type du proffeseur')
        ];
    }
    
}
