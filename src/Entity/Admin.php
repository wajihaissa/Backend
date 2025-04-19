<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends User
{
    #[ORM\Column(length: 255)]
    private ?string $role = null;

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    // Implementing UserInterface methods
    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function viewAllActivities(): array
    {
        // Implement logic to view all activities
        return [];
    }

    public function viewAllClients(): array
    {
        // Implement logic to view all clients
        return [];
    }

    public function viewAllProviders(): array
    {
        // Implement logic to view all providers
        return [];
    }

    public function modifyClient(Client $client): void
    {
        // Implement logic to modify a client
    }

    public function modifyProvider(Provider $provider): void
    {
        // Implement logic to modify a provider
    }

    public function modifyActivity(Activity $activity): void
    {
        // Implement logic to modify an activity
    }
}
