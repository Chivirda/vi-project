<?php

namespace App\DTO;

use App\Entity\BookingStatus;
use App\Entity\Flight;
use App\Entity\Passenger;
use App\Entity\Ticket;
use DateTimeInterface;

class TicketDTO
{
    private DateTimeInterface $departureDate;
    private int $totalPrice;
    private Flight $flight;
    private Passenger $passenger;
    private BookingStatus $bookingStatus;

    public static function createFromEntity(Ticket $ticket, Flight $flight): self
    {
        $dto = new self();

        $dto->setDepartureDate($ticket->getDepartureDate());
        $dto->setPassenger($ticket->getPassenger());
        $dto->setBookingStatus($ticket->getBookingStatus());
        $dto->setFlight($ticket->getFlight());

        if (date('w', $dto->getDepartureDate()) == 0 || date('w', $dto->getDepartureDate() == 6)) {
            $dto->setTotalPrice($flight->getBasicPrice() * 2);
        }

        return $dto;
    }

    public function getDepartureDate(): DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(DateTimeInterface $departureDate): void
    {
        $this->departureDate = $departureDate;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getFlight(): Flight
    {
        return $this->flight;
    }

    public function setFlight(Flight $flight): void
    {
        $this->flight = $flight;
    }

    public function getPassenger(): Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(Passenger $passenger): void
    {
        $this->passenger = $passenger;
    }

    public function getBookingStatus(): BookingStatus
    {
        return $this->bookingStatus;
    }

    public function setBookingStatus(BookingStatus $bookingStatus): void
    {
        $this->bookingStatus = $bookingStatus;
    }
}