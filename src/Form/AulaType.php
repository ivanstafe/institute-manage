<?php

namespace App\Form;

use App\Entity\Aula;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AulaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero')
            ->add('carrera')
            ->add('equipamiento')
            ->add('capacidad')
            ->add('caracteristicas')
            ->add('ubicacion')
            ->add('imagen', FileType::class, ['label' => 'Seleccione una imagen', 'mapped' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aula::class,
        ]);
    }
}
