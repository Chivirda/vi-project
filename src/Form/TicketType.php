<?php

namespace App\Form;

use App\DTO\TicketDTO;
use App\Entity\Flight;
use App\Entity\Passenger;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('departureDate', DateType::class, ['label' => 'Дата вылета', 'widget' => 'single_text'])
            ->add('flight', EntityType::class, ['label' => 'Рейс', 'class' => Flight::class,
                'choice_label' => 'number',
                ])
            ->add('passenger', EntityType::class, ['label' => 'Пассажир', 'class' => Passenger::class,
                'choice_label' => function (Passenger $passenger) {
                    return $passenger->getName() . ' ' . $passenger->getPatronymic() . ' ' . $passenger->getLastName();
                }])
            ->add('save', SubmitType::class, ['label' => 'Купить']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TicketDTO::class,
        ]);
    }
}
