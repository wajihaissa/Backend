<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Admin extends User
{
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
