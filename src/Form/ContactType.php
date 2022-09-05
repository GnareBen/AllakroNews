<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'row_attr' => [
                    'class' => 'col-6 mb-3'
                ],
            ])
            ->add('prenoms', TextType::class, [
                'row_attr' => [
                    'class' => 'col-6'
                ],
            ])
            ->add('prenoms', TextType::class, [
                'row_attr' => [
                    'class' => 'col-6 mb-3'
                ],
            ])
            ->add('objet', TextType::class, [
                'row_attr' => [
                    'class' => 'col-6 mb-3'
                ],
            ])
            ->add('contenu', TextareaType::class, [
                'row_attr' => [],
                'attr' => ['rows' => 6, 'col' => 10]
            ])
            ->add('numero', TextType::class, [
                'row_attr' => [
                    'class' => 'col-6 mb-3'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
