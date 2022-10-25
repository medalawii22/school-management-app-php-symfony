<?php

namespace App\Form;

use App\Model\Changepass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangepassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword',PasswordType::class, [
                'label' => 'the current password',
                'row_attr' => [
                ],
            ])
            ->add('newPassword',PasswordType::class)
            ->add('repeatNewPassword',PasswordType::class,[
                'label'=>"repeat the new password"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Changepass::class,
        ]);
    }
}
