<?php

namespace App\Form;

use App\Entity\Availability;
use App\Entity\Competence;
use App\Entity\Job;
use App\Entity\User;
use App\Entity\YearExperience;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "attr" => [
                    'placeholder' => "johnDoe@email.com",
                    'label' => 'E-mail'
                ]
            ]
            )
            ->add('roles', ChoiceType::class, [
                "choices" => [
                    "ADMIN" => "ROLE_ADMIN",
                    "USER" => "ROLE_USER"
                ], 
                'multiple' => true,
                'expanded' => true
            ])
            ->add('password', PasswordType::class, [
                "attr" => [
                    "placeholder" => "laisser vide si inchangé"
                ],
                "mapped" => false
            ])
            ->add('firstname', TextType::class, [
                
            ])
            ->add('lastname', TextType::class)
            ->add('town', TextType::class)
            ->add('cv', TextType::class)
            ->add('github', TextType::class)
            ->add('linkedin', TextType::class)
            ->add('portfolio', TextType::class)
            ->add('profilePicture', TextType::class)
            ->add('description', TextareaType::class)
            ->add('pricing', IntegerType::class)
            ->add('CreatedAt')
            ->add('updateAt')
            ->add('competences', EntityType::class, [
                'class' => Competence::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'id',
            ])
            ->add('yearExp', EntityType::class, [
                'class' => YearExperience::class,
                'choice_label' => 'id',
            ])
            ->add('availability', EntityType::class, [
                'class' => Availability::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
