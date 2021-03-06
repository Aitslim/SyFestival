<?php

namespace App\Form;

use App\Entity\Concert;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // A REVOIR : comment inclure la liste des concerts dans le formulaire.
        $builder
            ->add('nom', TextType::class, [
                "label" => "Nom",
            ])
            ->add('prenom', TextType::class, [
                "label" => "Prénom",
            ])
            ->add('telephone', TextType::class, [
                "label" => "Téléphone",
            ])
            ->add('places', TextType::class, [
                "label" => "Nb. de places",
            ])
            ->add('concert', EntityType::class, [
                'class' => Concert::class
            ])
            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
