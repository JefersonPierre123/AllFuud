<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     * @param  \App\Models\User|null  $user  // O '?' permite que o usuário seja nulo (visitante)
     * @param  \App\Models\Client  $client
     * @return bool
     */
    public function view(?User $user, Client $client): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $client): bool
    {
        return $user->client_id === $client->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CLient $client): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CLient $client): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CLient $client): bool
    {
        return false;
    }
}
