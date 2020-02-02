<?php

namespace App\Form;

use App\Entity\Animal;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\NumberFormatter\NumberFormatter;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class Animal3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',null,[
                'required' => true,
            ])
            ->add('BirthDate')
            ->add('Type',null,[
                'required' => true,
            ])
            ->add('Breed',null,[
                'required' => true,
            ])
            ->add('Sex', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please type the sex of the animal'
                    ]),
                ],
                'help' => 'Type M or F'

            ])
            ->add('Allergies', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please type if animal has any allergies'
                    ]),
                ],
                'help' => 'Type "no" or write the allergies of the animal'

            ])
            ->add('Weight', null, [
                'required' => true,
            ])
            ->add('HealthCard');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
