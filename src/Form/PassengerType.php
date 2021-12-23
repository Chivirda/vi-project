<?php

namespace App\Form;

use App\DTO\PassengerDTO;
use App\Entity\Passenger;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassengerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('lastName')
            ->add('patronymic')
            ->add('passportSeries')
            ->add('passportNumber')
            ->add('save', SubmitType::class, ['label' => 'Добавить пассажира'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PassengerDTO::class,
        ]);
    }
}
