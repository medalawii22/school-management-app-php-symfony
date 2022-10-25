<?php

namespace App\Controller\Admin;

use App\Entity\Notes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Notes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('value'),
            AssociationField::new('student'),
            AssociationField::new('element'),
        ];
    }
}
