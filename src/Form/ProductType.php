<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'label' => "Kategoriya",
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => "Rasm"
            ])
            ->add('title', TextType::class, [
                'label' => "Tovar haqida qisqacha",
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => "Tovar haqida to'liq ma'lumot",
                'attr' => ['rows' => 10],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => "Saqlash",
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->add('delete', SubmitType::class, [
                'label' => "O'chirish",
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
