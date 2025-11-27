<?php

namespace App\Form;

use App\Entity\BurialLocation;
use App\Entity\Locker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LockerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', IntegerType::class, [
                'label' => 'Número da Gaveta',
                'attr' => ['placeholder' => 'Ex: 101']
            ])
            ->add('local', EntityType::class, [
                'class' => BurialLocation::class,
                'label' => 'Localização Vinculada',
                'placeholder' => 'Selecione um local...',
                // Cria um label bonito: "Jazigo - Bloco A - Seção 1 - Nº 10"
                'choice_label' => function (BurialLocation $loc) {
                    return sprintf(
                        '%s | Bl: %s - Sec: %s - N: %s',
                        $loc->getType()->label(),
                        $loc->getBlock(),
                        $loc->getSection(),
                        $loc->getNumber()
                    );
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Locker::class,
        ]);
    }
}
