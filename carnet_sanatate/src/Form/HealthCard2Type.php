<?php

namespace App\Form;

use App\Entity\HealthCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HealthCard2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CardNumber', null,[
                'required' => true,
            ])
            ->add('Animal', null,[
                'help' => 'DO NOT CHANGE THIS WHEN EDIT. ONLY FOR CREATE',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HealthCard::class,
        ]);
    }
}
