<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\RotaParametro;
use Illuminate\Auth\Access\HandlesAuthorization;

class RotaParametroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rotaParametro can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the rotaParametro can view the model.
     */
    public function view(Usuario $usuario, RotaParametro $model): bool
    {
        return true;
    }

    /**
     * Determine whether the rotaParametro can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the rotaParametro can update the model.
     */
    public function update(Usuario $usuario, RotaParametro $model): bool
    {
        return true;
    }

    /**
     * Determine whether the rotaParametro can delete the model.
     */
    public function delete(Usuario $usuario, RotaParametro $model): bool
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
     * Determine whether the rotaParametro can restore the model.
     */
    public function restore(Usuario $usuario, RotaParametro $model): bool
    {
        return false;
    }

    /**
     * Determine whether the rotaParametro can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, RotaParametro $model): bool
    {
        return false;
    }
}
