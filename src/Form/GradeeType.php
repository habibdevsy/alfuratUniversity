<?php

namespace App\Form;

use App\Entity\GradeeEntity;
use App\Entity\UserEntity;
use App\Entity\SubjectEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class GradeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('user', EntityType::class,[
            'class'=>UserEntity::class,
            'choice_label'=>"userName",
            'label'=>"اسم الطالب",
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'أضف الطلاب أولا'
            ]
        ])
        ->add('Subject', EntityType::class,[
            'class'=>SubjectEntity::class,
            'choice_label'=>"subjectName",
            'label'=>"اسم المادة",
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'أضف المواد أولاً'
            ]
        ])
        ->add('grade', TextType::class,[
            'label'=>"الدرجة",
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'أدخل درجة الطالب',
                'maxlength' => 3
            ]
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GradeeEntity::class,
        ]);
    }
}
