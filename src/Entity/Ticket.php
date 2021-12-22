<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Flight::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity=Passenger::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passenger;

    /**
     * @ORM\Column(type="date")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalPrice;

    /**
     * @ORM\ManyToOne(targetEntity=BookingStatus::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookingStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getPassenger(): ?Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(?Passenger $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getBookingStatus(): ?BookingStatus
    {
        return $this->bookingStatus;
    }

    public function setBookingStatus(?BookingStatus $bookingStatus): self
    {
        $this->bookingStatus = $bookingStatus;

        return $this;
    }
}
