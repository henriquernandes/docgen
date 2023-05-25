<?php

namespace App\Policies;

use App\Models\Rota;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class RotaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rota can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the rota can view the model.
     */
    public function view(Usuario $usuario, Rota $model): bool
    {
        return true;
    }

    /**
     * Determine whether the rota can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the rota can update the model.
     */
    public function update(Usuario $usuario, Rota $model): bool
    {
        return true;
    }

    /**
     * Determine whether the rota can delete the model.
     */
    public function delete(Usuario $usuario, Rota $model): bool
    {
        return true;
    }

    /**
     * Determine whether the usuario can delete multiple instances of the model.
     */
    public function deleteAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the rota can restore the model.
     */
    public function restore(Usuario $usuario, Rota $model): bool
    {
        return false;
    }

    /**
     * Determine whether the rota can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Rota $model): bool
    {
        return false;
    }
}
