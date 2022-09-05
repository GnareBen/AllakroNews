<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'row_attr' => [
                    'class' => 'col-6 mb-4'
                ]
            ])
            ->add('imageName', FileType::class, [
                'required' => false,
                'mapped' => false,
                'row_attr' => [
                    'class' => 'col-6 '],
                'label' => 'Image'
            ])
            ->add('contenu', TextareaType::class, [
                'row_attr' => [
                    'class' => 'col-12'
                ],
                'attr'=>[
                    'rows'=>12,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
