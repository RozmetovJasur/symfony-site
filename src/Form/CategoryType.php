<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('image', FileType::class, [
                'required' => false
            ])
            ->add('delete', SubmitType::class, [
                'label' => "O'chirish",
                'row_attr' => [
                    'class' => "col-6 pull-right  text-start"
                ],
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => "Saqlash",
                'row_attr' => [
                    'class' => "col-6 pull-left text-end",
                ],
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
