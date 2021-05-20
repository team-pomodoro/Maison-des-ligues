<?php

namespace App\Form;

use App\Entity\Vacation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class VacationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Libelle', TextType::class)
            ->add('dateHeureDebut', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateHeureFin', DateTimeType::class, [
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vacation::class,
        ]);
    }
}