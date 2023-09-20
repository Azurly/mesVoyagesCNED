<?php

namespace App\Form;

use App\Entity\Visite;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ville')
            ->add('datecreation', null, ['widget' => 'single_text', 'data' => isset($options['data']) && $options['data']->getDateCreation() != null ? $options['data']->getDateCreation() : new DateTime('now'),'label' => 'Date'])
            ->add('note')
            ->add('avis')
            ->add('tempsmin', null, ['label' => 'Température Min'])
            ->add('tempsmax', null, ['label' => 'Température Max'])
            ->add('pays')
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visite::class,
        ]);
    }
}
