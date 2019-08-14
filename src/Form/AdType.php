<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('slug', TextType::class,[
                'required' => false
            ])
            ->add('coverImage', UrlType::class)
            ->add('introduction', TextType::class)
            ->add('content', TextareaType::class)
            ->add('price', MoneyType::class)
            ->add('rooms',IntegerType::class)
            ->add('images', CollectionType::class, array(
                'entry_type'   => ImageType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label' => ' '
            ))
            ->add('Enregistrer', SubmitType::class,[
                'label' => 'Enregistrer l\'annonce'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
