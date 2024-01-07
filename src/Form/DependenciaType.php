<?php

namespace App\Form;

use App\Entity\Dependencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DependenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('funcion')
            ->add('ubicacion')
            ->add('caracteristicas')
            ->add('imagen', FileType::class, ['label' => 'Seleccione una imagen', 'mapped' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dependencia::class,
        ]);
    }
}
