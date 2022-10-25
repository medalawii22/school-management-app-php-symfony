<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use App\Entity\Teacher;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;

class StudentCrudController extends AbstractCrudController
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher=$hasher;
    }
    public static function getEntityFqcn(): string
    {
        return Student::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('email')->setFormType(EmailType::class),
            TextField::new('password')->setFormType(PasswordType::class),
            TextField::new('numberPhone'),
            TextField::new('adresseLocal'),
            TextField::new('parentPhone'),

            AssociationField::new('classe'),
        ];
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if($entityInstance instanceof Student)
        {
            $entityInstance->setPassword(
                $this->hasher->hashPassword($entityInstance,$entityInstance->getPassword())                
            );
            $entityInstance->setRoles(['ROLE_STUDENT']);
            $entityManager->persist($entityInstance);
            $entityManager->flush();
            }
    }
}
