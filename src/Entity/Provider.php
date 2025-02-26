<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
class Provider extends User
{
    #[ORM\Column(length: 255)]
    private ?string $name = null; // Renamed to follow camelCase convention

    #[ORM\Column(nullable: true)]
    private ?float $revenue = null;

    public function getName(): ?string
    {
        return $this->name; // Updated to match the renamed property
    }

    public function setName(string $name): static // Updated to match the renamed property
    {
        $this->name = $name; // Updated to match the renamed property

        return $this;
    }

    public function getRevenue(): ?float
    {
        return $this->revenue;
    }

    public function setRevenue(?float $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }
}
