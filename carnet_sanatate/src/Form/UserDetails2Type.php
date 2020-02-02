<?php

namespace App\Form;

use App\Entity\UserDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserDetails2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName',null,[
                'required' => true,
            ])
            ->add('LastName',null,[
                'required' => true,
            ])
            ->add('BirthDate')
            ->add('Address')
            ->add('Phone', TelType::class,[
                'required' => true,
            ])
            ->add('User', null,[
                'help' => 'Your user id',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserDetails::class,
        ]);
    }
}
