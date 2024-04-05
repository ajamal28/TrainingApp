<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'vehichle', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cars $car = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Planes $plane = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bikes $bike = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCar(): ?Cars
    {
        return $this->car;
    }

    public function setCar(Cars $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getPlane(): ?Planes
    {
        return $this->plane;
    }

    public function setPlane(Planes $plane): static
    {
        $this->plane = $plane;

        return $this;
    }

    public function getBike(): ?Bikes
    {
        return $this->bike;
    }

    public function setBike(Bikes $bike): static
    {
        $this->bike = $bike;

        return $this;
    }
}
