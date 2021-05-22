<?php

namespace App\Form;

use App\Entity\SubjectEntity;
use App\Entity\CollegeEntity;
use Doctrine\DBAL\Types\JsonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('college', EntityType::class,[
            'class'=>CollegeEntity::class,
            'choice_label'=>"collegeName",
            'label'=>"الكلية",
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'أدخل الكليات أولاً'
            ]
        ])
        ->add('subjectName', TextType::class,[
            'label'=>"اسم المادة",
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'أدخل اسم المادة'
            ]
        ])
        ->add('passingGrade', TextType::class,[
            'label'=>"درجة النجاح",
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'أدخل درجة النجاح',
                'maxlength' => 3
            ]
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SubjectEntity::class,
        ]);
    }
}
