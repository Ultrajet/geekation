<?php

namespace App\Form;

use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('adresse')
            ->add('code_postal')
            ->add('ville')
            ->add('date_de_naissance')
            ->add('telephone')
            ->add('scan_CNI')
            ->add('RIB')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membres::class,
        ]);
    }
}
