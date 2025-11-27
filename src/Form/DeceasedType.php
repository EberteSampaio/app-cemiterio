<?php

namespace App\Form;

use App\Entity\BurialLocation;
use App\Entity\Deceased;
use App\Entity\Locker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeceasedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nome do Falecido'
            ])
            ->add('date_of_death', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Data do Falecimento',
                'required' => false,
            ])
            ->add('local', EntityType::class, [
                'class' => BurialLocation::class,
                'choice_label' => function (BurialLocation $loc) {
                    return sprintf(
                        '%s - Bloco %d - Seção %d - Número %d',
                        $loc->getType()->label(),
                        $loc->getBlock(),
                        $loc->getSection(),
                        $loc->getNumber()
                    );
                },
                'label' => 'Local de Sepultamento'
            ])
            ->add('locker', EntityType::class, [
                'class' => Locker::class,
                'choice_label' => fn(Locker $l) => 'Locker ' . $l->getNumber(),
                'label' => 'Gaveta (se houver)',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deceased::class,
        ]);
    }
}
