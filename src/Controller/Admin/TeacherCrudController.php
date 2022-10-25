<?php

namespace App\Controller\Admin;

use App\Entity\Teacher;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class TeacherCrudController extends AbstractCrudController
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher=$hasher;
    }
    public static function getEntityFqcn(): string
    {
        return Teacher::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName'),
            TextField::new('lastName'),
            TelephoneField::new('numberPhone'),
            TextField::new('email'),
            TextField::new('password'),
            AssociationField::new('typeProf')
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if($entityInstance instanceof Teacher)
        {
            $entityInstance->setPassword(
                $this->hasher->hashPassword($entityInstance,$entityInstance->getPassword())
            );
            $entityInstance->setRoles(['ROLE_TEACHER']);
            $entityManager->persist($entityInstance);
            $entityManager->flush();
        }
    }
    
}
