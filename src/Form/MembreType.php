<?php

namespace App\Form;

use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
                        'pattern'=> '/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                        'message'=>"Veuillez saisir un Mot de Passe composer d'une minuscule, d'une majuscule et d un chiffre (6 caracteres mini)"
                    ))
                )
            ))

            ->add('prenom',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 25,
                        'minMessage' => 'Veuillez mettre un prenom avec 3 caractère minimum ',
                        'maxMessage' => 'Veuillez mettre un prenom avec 25 caractère maximum '
                    ))
                )
            ))

            ->add('nom',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 25,
                        'minMessage' => 'Veuillez mettre un nom avec 3 caractère minimum ',
                        'maxMessage' => 'Veuillez mettre un nom avec 25 caractère maximum '
                    ))
                )
            ))

            ->add('email',EmailType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Email(array(
                        'message' => '{{ value }} n est pas un email valide'
                    )),
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 40,
                        'minMessage' => 'Veuillez mettre un email avec 3 caractère minimum ',
                        'maxMessage' => 'Veuillez mettre un email avec 40 caractère maximum '
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
                    )),
                    new Assert\Length(array(
                        'min' => 5,
                        'max' => 5,
                    ))
                )
            ))

            ->add('ville',TextType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Length(array(
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'Veuillez mettre un ville avec 3 caractère minimum ',
                        'maxMessage' => 'Veuillez mettre une ville avec 40 caractère maximum '
                    ))
                )
            ))

            ->add('date_de_naissance',BirthdayType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    ))
                )
            ))

            ->add('telephone',IntegerType::class,array(
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez remplir le champ'
                    )),
                    new Assert\Regex(array(
                        'pattern' => "/^[1-68]([-. ]?[0-9]{2}){4}$/",
                        'message' => "Numero de téléphone non valide"
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
