<?php

namespace App\Form;

use App\DTO\PassengerDTO;
use App\Entity\Passenger;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassengerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, ['label' => 'Фамилия'])
            ->add('name', TextType::class, ['label' => 'Имя'])
            ->add('patronymic', TextType::class, ['label' => 'Отчество'])
            ->add('passportSeries', NumberType::class, ['label' => 'Серия'])
            ->add('passportNumber', NumberType::class, ['label' => 'Номер'])
            ->add('save', SubmitType::class, ['label' => 'Добавить пассажира'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PassengerDTO::class,
            'attr' => ['class' => 'd-flex justify-content-evenly row g-5']
        ]);
    }
}
