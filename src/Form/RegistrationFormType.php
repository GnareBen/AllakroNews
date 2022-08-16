<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Nom'],
                'row_attr' => ['class' => 'col-md-6 mb-3']
            ])
            ->add('prenoms', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Prenoms'],
                'row_attr' => ['class' => 'col-md-6 mb-3'],
            ])
            ->add('username', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'exemple : GnareBen55'],
                'row_attr' => ['class' => 'col-md-6 mb-3'],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'exemple@mail.com'],
                'row_attr' => ['class' => 'col-md-6 mb-3'],
                'constraints' =>[
                    new Email([
                        'message' => 'veuillez entrer une adresse email valide',
                    ])
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme'
                ],
                'row_attr' => ['class' => 'col-md-6  mb-3']
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'required' => true,
                'row_attr' => ['class' => 'col-md-6  mb-3'],
            ])
            ->add('plainPassword', PasswordType::class, [
                'required' => true,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Nouveau mot de passe'],
                'row_attr' => [
                    'class' => 'col-md-6 mb-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('plainPassword2', PasswordType::class, [
                'required' => true,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Répétez votre mot de passe'
                ],
                'row_attr' => [
                    'class' => 'col-md-6 mb-3'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                         ]),
                    ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
