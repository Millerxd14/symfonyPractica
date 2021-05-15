<?php

namespace App\Form;

use App\Entity\Estudiantemateria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudianteMateriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estudiante', NumberType::class,  array('attr' => array('readonly' => 'true')))
            ->add('materia', NumberType::class, array('attr' => array('readonly' => 'true')))
            ->add('Asociar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estudiantemateria::class,
        ]);
    }
}
