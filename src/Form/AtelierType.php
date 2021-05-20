<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use App\Entity\Theme;
use App\Entity\Vacation;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('nbPlaceMaxi', NumberType::class)
            ->add('themes', EntityType::class,[
                'class' => Theme::class,
               'choice_label' => function ($theme) {
                   return $theme->getLibelle();
               },
               'multiple' => true,
               'attr' => [
                   'class' => 'select_themes'
               ]
           ])
            // ->add('themes', EntityType::class,[
            //       'class' => Theme::class,
            //       'choice_label' => 'libelle',
            //       'expanded' => true,
            //       'multiple' => true,
            // ])
            ->add('vacations', EntityType::class,[
                'class' => Vacation::class,
                'choice_label' => 'libelle',
                'expanded' => true,
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}