<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {

                $form = $event->getForm();
                $user = $event->getData();

                // If user id doesn't exist
                if($user->getId() === null) {

                    // If new user
                    $form->add('password', RepeatedType::class, [
                        'type'              => PasswordType::class,
                        'invalid_message'   => 'Les mots de passe ne correspondent pas.',
                        'first_options'     => [
                            'constraints'   => new NotBlank(),
                            'label'         => 'Mot de passe',
                            'help'          => 'Minimum eight characters, at least one letter, one number and one special character.'
                        ],
                        'second_options' => ['label' => 'Répéter le mot de passe'],
                    ]);

                } else {
                    // If user exists
                    $form->add('password', RepeatedType::class, [
                        'type'            => PasswordType::class,
                        'invalid_message' => 'Les mots de passe ne correspondent pas.',
                        // if need replace null by value we can use "empty data"
                        'mapped' => false,
                        //'required' => true,
                        'first_options'  => [
                            'constraints' => [
                                new Regex('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&-\/])[A-Za-z\d@$!%*#?&-\/]{8,}$/'),
                                new NotCompromisedPassword(),
                            ],
                            'attr' => [
                                'placeholder' => 'Laissez vide si inchangé...',
                            ],
                            'label' => 'Mot de passe',
                            'help' => 'Minimum eight characters, at least one letter, one number and one special character.'
                        ],
                        'second_options' => ['label' => 'Répéter le mot de passe'],
                    ]);
                }
            })
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Membre' => 'ROLE_USER',
                    'Manager' => 'ROLE_MANAGER',
                    'Administrateur' => 'ROLE_ADMIN'
                ],
                // $roles = array = multiple
                'multiple' => true,
                // checkboxes
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
