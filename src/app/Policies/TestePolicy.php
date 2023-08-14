<?php

namespace App\Policies;

use App\Models\Teste;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the teste can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the teste can view the model.
     */
    public function view(Usuario $usuario, Teste $model): bool
    {
        return true;
    }

    /**
     * Determine whether the teste can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the teste can update the model.
     */
    public function update(Usuario $usuario, Teste $model): bool
    {
        return true;
    }

    /**
     * Determine whether the teste can delete the model.
     */
    public function delete(Usuario $usuario, Teste $model): bool
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
     * Determine whether the teste can restore the model.
     */
    public function restore(Usuario $usuario, Teste $model): bool
    {
        return false;
    }

    /**
     * Determine whether the teste can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Teste $model): bool
    {
        return false;
    }
}
