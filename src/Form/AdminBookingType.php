<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\User;
use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('endDate', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('comment')
            ->add('booker',EntityType::class,[
                'class' => User::class,
                'choice_label' => 'fullName'
            ])
            ->add('ad',EntityType::class,[
                'class' => Ad::class,
                'choice_label' => 'title'
            ])
            ->add('Enregistrer', SubmitType::class,[
                'label' => 'Modifier la réservation'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
