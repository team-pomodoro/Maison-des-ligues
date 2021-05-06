<?php

namespace App\Form;

use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class GestionCompte extends AbstractType {

    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('numLicence', TextType::class,['disabled'=>true,'required'=>false])
                ->add('nom', TextType::class,['disabled'=>true,'required'=>false])
                ->add('prenom', TextType::class,['disabled'=>true,'required'=>false])
                ->add('email', EmailType::class,['disabled'=>true,'required'=>false])

//                ->add('plainPassword', RepeatedType::class, array(
//                    'type' => PasswordType::class,
//                    'first_options' => array('label' => 'Password'),
//                    'second_options' => array('label' => 'Repeat Password'),
//                    'disabled'=>true,
//                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => Compte::class,
        ));
    }

}
