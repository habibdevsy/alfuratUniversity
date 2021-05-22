<?php

namespace App\Form;

use App\Entity\UserEntity;
use App\Entity\CollegeEntity;
use Doctrine\DBAL\Types\JsonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class UserType extends AbstractType
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
            ->add('userName', TextType::class,[
                'label'=>"اسم الطالب",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'أدخل اسم الطالب'
                ]
            ])
            ->add('cardNumber', TextType::class,[
                'label'=>"رقم البطاقة الجامعية",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'أدخل رقم البطاقة الجامعية'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserEntity::class,
        ]);
    }
}
