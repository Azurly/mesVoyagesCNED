<?php

namespace App\Form;

use DateTime;
use App\Entity\Visite;
use App\Entity\Environnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ville')
            ->add('datecreation', null, ['widget' => 'single_text', 'data' => isset($options['data']) && $options['data']->getDateCreation() != null ? $options['data']->getDateCreation() : new DateTime('now'), 'label' => 'Date'])
            ->add('note')
            ->add('avis')
            ->add('tempsmin', null, ['label' => 'Température Min'])
            ->add('tempsmax', null, ['label' => 'Température Max'])
            ->add('environnements', EntityType::class, ['class' => Environnement::class, 'choice_label' => 'nom', 'multiple' => true, 'required' => false])
            ->add('pays')
            ->add('imageFile', FileType::class, ['required' => false, 'label' => 'Sélection Image'])
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