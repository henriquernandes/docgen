<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpresaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the empresa can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the empresa can view the model.
     */
    public function view(Usuario $usuario, Empresa $model): bool
    {
        return true;
    }

    /**
     * Determine whether the empresa can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the empresa can update the model.
     */
    public function update(Usuario $usuario, Empresa $model): bool
    {
        return true;
    }

    /**
     * Determine whether the empresa can delete the model.
     */
    public function delete(Usuario $usuario, Empresa $model): bool
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
     * Determine whether the empresa can restore the model.
     */
    public function restore(Usuario $usuario, Empresa $model): bool
    {
        return false;
    }

    /**
     * Determine whether the empresa can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Empresa $model): bool
    {
        return false;
    }
}
