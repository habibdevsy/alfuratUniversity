<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adminName', TextType::class,[
                'label'=>"اسم المستخدم",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'أدخل اسم المستخدم'
                ]
            ])
            ->add('adminPass', TextType::class,[
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
            // Configure your form options here
        ]);
    }
}
