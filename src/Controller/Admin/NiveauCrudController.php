<?php

namespace App\Controller\Admin;

use App\Entity\Niveau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NiveauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Niveau::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
