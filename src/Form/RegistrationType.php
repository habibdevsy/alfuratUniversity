<?php

namespace App\Form;

use App\Entity\UserRegistration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'label'=>"اسم المستخدم",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'رقم البطاقة الجامعية مسبوقاً برمز الكلية'
                ]
            ])
            // ->add('roles')
            ->add('password', TextType::class,[
                'label'=>"كلمةالمرور",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'أدخل كلمة المرور'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserRegistration::class,
        ]);
    }
}
