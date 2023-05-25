<?php

namespace App\Policies;

use App\Models\Metodo;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the metodo can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the metodo can view the model.
     */
    public function view(Usuario $usuario, Metodo $model): bool
    {
        return true;
    }

    /**
     * Determine whether the metodo can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the metodo can update the model.
     */
    public function update(Usuario $usuario, Metodo $model): bool
    {
        return true;
    }

    /**
     * Determine whether the metodo can delete the model.
     */
    public function delete(Usuario $usuario, Metodo $model): bool
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
     * Determine whether the metodo can restore the model.
     */
    public function restore(Usuario $usuario, Metodo $model): bool
    {
        return false;
    }

    /**
     * Determine whether the metodo can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Metodo $model): bool
    {
        return false;
    }
}
