<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="departureFlights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departureAirport;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="arrivalFlights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arrivalAirport;

    /**
     * @ORM\ManyToOne(targetEntity=FlightStatus::class, inversedBy="flights")
     */
    private $status;

    /**
     * @ORM\Column(type="time")
     */
    private $travelTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $basicPrice;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="flight", orphanRemoval=true)
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDepartureAirport(): ?Airport
    {
        return $this->departureAirport;
    }

    public function setDepartureAirport(?Airport $departureAirport): self
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    public function getArrivalAirport(): ?Airport
    {
        return $this->arrivalAirport;
    }

    public function setArrivalAirport(?Airport $arrivalAirport): self
    {
        $this->arrivalAirport = $arrivalAirport;

        return $this;
    }

    public function getStatus(): ?FlightStatus
    {
        return $this->status;
    }

    public function setStatus(?FlightStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTravelTime(): ?\DateTimeInterface
    {
        return $this->travelTime;
    }

    public function setTravelTime(\DateTimeInterface $travelTime): self
    {
        $this->travelTime = $travelTime;

        return $this;
    }

    public function getBasicPrice(): ?int
    {
        return $this->basicPrice;
    }

    public function setBasicPrice(?int $basicPrice): self
    {
        $this->basicPrice = $basicPrice;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setFlight($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getFlight() === $this) {
                $ticket->setFlight(null);
            }
        }

        return $this;
    }
}
