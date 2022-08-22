<?php

namespace App\Form;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Nom'],
                'row_attr' => ['class' => 'col-md-4']
            ])
            ->add('prenoms', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Prenoms'],
                'row_attr' => ['class' => 'col-md-4'],
            ])
            ->add('username', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'exemple : GnareBen55'],
                'row_attr' => ['class' => 'col-md-4'],
                'label' => "Nom d'utilisateur"
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'exemple@mail.com'],
                'row_attr' => ['class' => 'col-md-4 mt-3'],
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
                'row_attr' => ['class' => 'col-md-4 mt-3']
            ])
            ->add('number', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre numéro'],
                'row_attr' => [
                    'class' => 'col-md-4 mt-3'],
                'label' => "Numéro de portable"
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'required' => true,
                'row_attr' => ['class' => 'col-md-4 mt-3'],
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'row_attr' => [],
                'attr' => ['rows' => 6, 'col' => 50]
            ])
            ->add('imageName', FileType::class, [
                'required' => false,
                'mapped' => false,
                'row_attr' => ['class' => 'col-md-4 mt-4'],
                'label' => 'Photo'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
