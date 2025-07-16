<?php

namespace App\Form;

use App\Entity\Provincia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProvinciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nombre', TextType::class, [
            'label' => 'Provincia',
        ])
                ->add('poblacion', IntegerType::class, [
            'required' => false,
            'label' => 'Población',
        ])
        ->add('superficie', NumberType::class, [ 
            'required' => false,
            'label' => 'Superficie',
        ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Provincia::class,
        ]);
    }
}
