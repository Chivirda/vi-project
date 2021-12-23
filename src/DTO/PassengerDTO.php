<?php

namespace App\DTO;

use App\Entity\Passenger;

class PassengerDTO
{
    private string $name;
    private string $lastName;
    private ?string $patronymic;
    private int $passportSeries;
    private int $passportNumber;

    public static function createFromEntity(Passenger $passenger): self
    {
        $dto = new self();

        $dto->setName($passenger->getName());
        $dto->setLastName($passenger->getLastName());

        if ($passenger->getPatronymic()) {
            $dto->setPatronymic($passenger->getPatronymic());
        }

        $dto->setPassportNumber($passenger->getPassportNumber());
        $dto->setPassportSeries($passenger->getPassportSeries());

        return $dto;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    public function getPassportSeries(): int
    {
        return $this->passportSeries;
    }

    public function setPassportSeries(int $passportSeries): void
    {
        $this->passportSeries = $passportSeries;
    }

    public function getPassportNumber(): int
    {
        return $this->passportNumber;
    }

    public function setPassportNumber(int $passportNumber): void
    {
        $this->passportNumber = $passportNumber;
    }
}