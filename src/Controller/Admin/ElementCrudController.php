<?php

namespace App\Controller\Admin;
use Doctrine\ORM\Tools\ResolveTargetEntityListener;
use App\Entity\Element;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ElementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Element::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomElement'),
            NumberField::new('coefficient'),
            AssociationField::new('module'),
            AssociationField::new('teacher')

        ];
    }
    
}
