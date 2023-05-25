<?php

namespace App\Policies;

use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the usuario can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->isSuperAdmin();
    }

    /**
     * Determine whether the usuario can view the model.
     */
    public function view(Usuario $usuario, Usuario $model): bool
    {
        return $usuario->isSuperAdmin();
    }

    /**
     * Determine whether the usuario can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->isSuperAdmin();
    }

    /**
     * Determine whether the usuario can update the model.
     */
    public function update(Usuario $usuario, Usuario $model): bool
    {
        return $usuario->isSuperAdmin();
    }

    /**
     * Determine whether the usuario can delete the model.
     */
    public function delete(Usuario $usuario, Usuario $model): bool
    {
        return $usuario->isSuperAdmin();
    }

    /**
     * Determine whether the usuario can delete multiple instances of the model.
     */
    public function deleteAny(Usuario $usuario): bool
    {
        return $usuario->isSuperAdmin();
    }

    /**
     * Determine whether the usuario can restore the model.
     */
    public function restore(Usuario $usuario, Usuario $model): bool
    {
        return false;
    }

    /**
     * Determine whether the usuario can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Usuario $model): bool
    {
        return false;
    }
}
