<?php

namespace App\Policies;

use App\Models\Establishment;
use App\Models\User;
use App\Models\Product;

class ProductPolicy
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
     * @param  \App\Models\Establishment  $establishment
     * @return bool
     */
    public function view(?User $user, Establishment $establishment): bool
    {
        // 1. Se o usuário não estiver logado, $user será null.
        // Neste caso, permitimos que qualquer visitante veja a página.
        if (is_null($user)) {
            return true;
        }

        // 2. Se o usuário ESTIVER logado, a lógica antiga se aplica.
        // Ele precisa ser o dono OU um cliente.
        return $user->establishment_id === $establishment->id || !is_null($user->client_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return !is_null($user->establishment_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        // A lógica para update continua a mesma, restrita ao dono.
        return $user->establishment_id === $product->establishment_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Establishment $establishment): bool
    {
        // A lógica para delete também continua a mesma.
        return $user->establishment_id === $establishment->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Establishment $establishment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Establishment $establishment): bool
    {
        return false;
    }
}