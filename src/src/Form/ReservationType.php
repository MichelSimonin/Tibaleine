<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\ReservationRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', null, ['label' => 'Prénom', 'attr' => ['placeholder' => 'Jean']])
            ->add('nom', null, ['label' => 'Nom', 'attr' => ['placeholder' => 'Dupont']])
            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'jean.dupont@exemple.com']])
            ->add('telephone', TelType::class, ['label' => 'Téléphone', 'attr' => ['placeholder' => '06 92 00 00 00']])
            ->add('nbAdultes', IntegerType::class, ['label' => "Nombre d'adultes", 'attr' => ['min' => 0]])
            ->add('nbEnfants', IntegerType::class, ['label' => "Nombre d'enfants (4 à 11 ans)", 'attr' => ['min' => 0]])
            ->add('motDePasse', PasswordType::class, [
                'label' => 'Mot de passe (facultatif)',
                'required' => false,
                'help' => 'Ajoutez un mot de passe pour retrouver vos réservations.',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ReservationRequest::class]);
    }
}
