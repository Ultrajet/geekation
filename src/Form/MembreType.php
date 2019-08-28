<?php

namespace App\Form;

use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;


class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'Veuillez mettre un pseudo avec 3 caractère minimum ',
                        'maxMessage' => 'Veuillez mettre un pseudo avec 30 caractère maximum '
                    ))
                )
            ))

            ->add('password',PasswordType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new  Assert\Regex(array(
                        'pattern'=> '"/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/"',
                        'message'=>"Veuillez saisir un MP composer d'une minuscule, d'une majuscule et d un chiffre (8 caracteres mini)"
                    ))
                )
            ))

            ->add('prenom',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('nom',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('email',EmailType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Email(array(
                        'message' => 'Veuillez remplir un Email Valide!'
                    ))
                )
            ))

            ->add('adresse',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('code_postal',IntegerType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('ville',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('date_de_naissance',DateTimeType::class)

            ->add('telephone',IntegerType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('scan_CNI')

            ->add('RIB')

            ->add('sexe',ChoiceType::class,array(
                'choices' => array(
                    'Homme' => 'h',
                    'Femme' => 'f',
                    'Non Binaire' => 'b'
                )
                ))
            ->add('submit', SubmitType::class);
                
                ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membres::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
