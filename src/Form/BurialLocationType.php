<?php

namespace App\Form;

use App\Entity\BurialLocation;
use App\Enum\TypeBurialLocal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BurialLocationType extends AbstractType
{
    // src/Form/BurialLocationType.php

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('block', null, [
                'label' => 'Bloco',
                'attr' => ['placeholder' => 'Ex: A']
            ])
            ->add('section', null, [
                'label' => 'Seção/Quadra',
                'attr' => ['placeholder' => 'Ex: 12']
            ])
            ->add('number', null, [
                'label' => 'Número do Jazigo',
                'attr' => ['placeholder' => 'Ex: 105']
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Tipo de Sepultamento',
                'choices' => TypeBurialLocal::cases(),
                'choice_label' => fn(TypeBurialLocal $t) => $t->label(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BurialLocation::class,
        ]);
    }
}
