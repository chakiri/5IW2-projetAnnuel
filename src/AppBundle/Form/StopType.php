<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StopType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lat', HiddenType::class, array(
                'label' => 'Latitude'
            ))
            ->add('lon', HiddenType::class, array(
                'label' => 'Longitude'
            ))
            ->add('title', TextType::class, array(
                'required' => false,
                'label' => 'Titre de l\'étape'
            ))
            ->add('description', TextareaType::class, array(
                'required' => false,
                'label' => 'Description de l\'étape'
            ))
            ->add('address', TextType::class, array(
                'required' => true,
                'label' => 'Adresse',
                'attr' => array(
                    'class' => 'autocomplete-field autocomplete'
                )
            ))
            //->add('lat', HiddenType::class)
            //->add('lon', HiddenType::class);
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stop',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stop';
    }


}
