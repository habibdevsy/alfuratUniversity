<?php

namespace App\Form;

use App\Entity\CollegeEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CollegeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('collegeName', TextType::class,[
                'label'=>"اسم الكلية",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'أدخل اسم الكلية',
                    'maxlength' => 3
                ]
            ])
            // ->add('collegeCode', TextType::class,[
            //     'label'=>"رمز الكلية",
            //     'attr' => [
            //         'class' => 'form-control',
            //         'placeholder' => 'أدخل رمز الكلية',
            //         'maxlength' => 3
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CollegeEntity::class,
        ]);
    }
}
