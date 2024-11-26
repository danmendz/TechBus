<?php

namespace App\Policies;

use App\Models\Ruta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RutaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isOperativo() || $user->isConductor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ruta $ruta): bool
    {
        return $user->isAdmin() || $user->isOperativo() || $user->isConductor();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isOperativo();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ruta $ruta): bool
    {
        return $user->isAdmin() || $user->isOperativo();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ruta $ruta): bool
    {
        return $user->isAdmin() || $user->isOperativo();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ruta $ruta): bool
    {
        return $user->isAdmin() || $user->isOperativo();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ruta $ruta): bool
    {
        return $user->isAdmin() || $user->isOperativo();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
        
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->isAdmin();
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdmin();
        
    }
}
