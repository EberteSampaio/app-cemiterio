<?php

namespace App\Form;

use App\Entity\BurialLocation;
use App\Entity\Deceased;
use App\Entity\Locker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Deceased1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('created_at')
            ->add('updated_at')
            ->add('date_of_death')
            ->add('name')
            ->add('local', EntityType::class, [
                'class' => BurialLocation::class,
                'choice_label' => 'id',
            ])
            ->add('locker', EntityType::class, [
                'class' => Locker::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deceased::class,
        ]);
    }
}
