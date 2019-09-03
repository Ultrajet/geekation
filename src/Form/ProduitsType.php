<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prix')
            ->add('type',ChoiceType::class,array(
                'choices' => array(
                    'Console' => 'console',
                    'Jeux' => 'jeux',
                    'Accesoire' => 'accesoire'
                )
                ))
            ->add('univers',ChoiceType ::class,array(
                'choices' => array(
                    'Sony' => 'sony',
                    'Microsoft' => 'microsoft',
                    'Nintendo' => 'nintendo'
                )
                ))
            ->add('submit', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
