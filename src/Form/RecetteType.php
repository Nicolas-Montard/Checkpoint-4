<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'gratin dauphinois',
                    'class' => 'form-control',
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-control category'
                ]
            ])
            ->add('pictureFile', VichFileType::class, [
                'required' => true,
                'label' => 'Image de la recette',
                'attr' => [
                    'placeholder' => 'Ajouter un fichier',
                    'class' => 'pictureFile'
                    ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description',
                    'class' => 'form-control other-field'
                    ]
            ])
            ->add('ingredient', TextareaType::class, [
                'label' => 'Ingredients',
                'attr' => [
                    'placeholder' => 'Ingredients',
                    'class' => 'form-control other-field'
                ]
            ])
            ->add('step', TextareaType::class, [
                'label' => 'Etapes',
                'attr' => [
                    'placeholder' => 'Etape',
                    'class' => 'form-control other-field'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
