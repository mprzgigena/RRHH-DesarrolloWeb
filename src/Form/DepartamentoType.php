<?php

namespace App\Form;

use App\Entity\Departamento;
use App\Entity\Empleado;
use App\Entity\Ubicacion; 
use App\Form\EmpleadoType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType; 

class DepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre del Departamento',
                'required' => true,
            ])
            ->add('ubicacion', EntityType::class, [
                'class' => Ubicacion::class,
                'choice_label' => 'ciudad', 
                'placeholder' => 'Seleccione una ubicación',
                'required' => false,
                'label' => 'Ubicación',
            ])
            ->add('jefe', EntityType::class, [
                'class' => Empleado::class,
                'choice_label' => function(Empleado $empleado) {
                    return $empleado->getNombre() . ' ' . $empleado->getApellido();
                },
                'placeholder' => 'Seleccione un jefe (opcional)',
                'required' => false,
                'label' => 'Jefe del Departamento',
            ])
            ->add('empleados', CollectionType::class, [
                'entry_type' => EmpleadoType::class, 
                'allow_add' => true, 
                'allow_delete' => true, 
                'by_reference' => false, 
                'label' => 'Empleados del Departamento',
                'entry_options' => ['label' => false], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Departamento::class,
        ]);
    }
}