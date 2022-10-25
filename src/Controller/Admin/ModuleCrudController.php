<?php

namespace App\Controller\Admin;

use App\Entity\Module;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ModuleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Module::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomModule'),
            TextField::new('description'),
            AssociationField::new('classe')
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->showEntityActionsAsDropdown(false);

    }
}
