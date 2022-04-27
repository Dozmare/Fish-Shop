<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control form-login']
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control form-login']
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control form-login']
            ])
            ->add('adress', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control form-login']
            ])
            ->add('zipCode', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control form-login']
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control form-login']
            ])
            /*->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez les thermes.',
                    ]),
                ],
            ])*/
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password','class' => 'form-control form-login'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
