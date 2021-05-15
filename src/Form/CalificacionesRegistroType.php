<?php

namespace App\Form;

use App\Entity\CalificacionesFinales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalificacionesRegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estudiante', NumberType::class,array('attr' => array('readonly' => 'true')))
            ->add('materia',NumberType::class,array('attr' => array('readonly' => 'true')))
            ->add('nombreEstudiante',TextType::class,array('attr' => array('readonly' => 'true')))
            ->add('nombreMateria', TextType::class,array('attr' => array('readonly' => 'true')))
            ->add('calificacionFinal', NumberType::class)
            ->add('Guardar',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CalificacionesFinales::class,
        ]);
    }
}
