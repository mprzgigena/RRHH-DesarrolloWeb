<?php

namespace App\Form;

use App\Entity\Empleado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType; 
use Symfony\Component\Form\Extension\Core\Type\DateType;   
use Symfony\Component\Form\Extension\Core\Type\NumberType;  

class EmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre del Empleado',
                'required' => true,
            ])
            ->add('apellido', TextType::class, [
                'label' => 'Apellido del Empleado',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('telefono', IntegerType::class, [
                'label' => 'Teléfono',
                'required' => false,
            ])
            ->add('fechaIngreso', DateType::class, [
                'label' => 'Fecha de Ingreso',
                'widget' => 'single_text', 
                'required' => false,
            ])
            ->add('salario', NumberType::class, [
                'label' => 'Salario',
                'scale' => 2, // 2 decimales
                'required' => false,
            ])
            ->add('comision', NumberType::class, [
                'label' => 'Comisión',
                'scale' => 2, // 2 decimales
                'required' => false,
            ])
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empleado::class,
        ]);
    }
}