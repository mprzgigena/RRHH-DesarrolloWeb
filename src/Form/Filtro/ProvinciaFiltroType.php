// src/Form/Filtro/ProvinciaFiltroType.php

namespace App\Form\Filtro;

use App\Entity\Pais; // Necesario para el campo 'pais'
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType; // Para minPoblacion y maxSuperficie
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Para el botón de enviar

class ProvinciaFiltroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pais', EntityType::class, [
                'class' => Pais::class,
                'choice_label' => 'nombre', // Muestra el nombre del país en el select
                'placeholder' => 'Seleccione un País (Opcional)', // Opción por defecto
                'required' => false, // El filtro por país es opcional
                'label' => 'País',
            ])
            ->add('minPoblacion', NumberType::class, [
                'label' => 'Población Mínima',
                'html5' => true, // Para usar controles HTML5 si el navegador los soporta
                'required' => false, // Este filtro es opcional
            ])
            ->add('maxSuperficie', NumberType::class, [
                'label' => 'Superficie Máxima',
                'html5' => true, // Para usar controles HTML5
                'required' => false, // Este filtro es opcional
            ])
            ->add('filtrar', SubmitType::class, [
                'label' => 'Filtrar',
                'attr' => ['class' => 'btn btn-primary'], // Estilo para el botón
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Este formulario no está directamente asociado a una entidad
            'data_class' => null,
            'csrf_protection' => true, // Protección CSRF habilitada por defecto
        ]);
    }

   
    public function getBlockPrefix(): string
    {
        return 'provincia_filtro';
    }
}