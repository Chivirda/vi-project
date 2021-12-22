<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=90)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Airport::class, mappedBy="city", orphanRemoval=true)
     */
    private $airportInThisCity;

    public function __construct()
    {
        $this->airportInThisCity = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Airport[]
     */
    public function getAirportInThisCity(): Collection
    {
        return $this->airportInThisCity;
    }

    public function addAirportInThisCity(Airport $airportInThisCity): self
    {
        if (!$this->airportInThisCity->contains($airportInThisCity)) {
            $this->airportInThisCity[] = $airportInThisCity;
            $airportInThisCity->setCity($this);
        }

        return $this;
    }

    public function removeAirportInThisCity(Airport $airportInThisCity): self
    {
        if ($this->airportInThisCity->removeElement($airportInThisCity)) {
            // set the owning side to null (unless already changed)
            if ($airportInThisCity->getCity() === $this) {
                $airportInThisCity->setCity(null);
            }
        }

        return $this;
    }
}
