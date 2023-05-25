<?php

namespace App\Policies;

use App\Models\Erros;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ErrosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the erros can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the erros can view the model.
     */
    public function view(Usuario $usuario, Erros $model): bool
    {
        return true;
    }

    /**
     * Determine whether the erros can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the erros can update the model.
     */
    public function update(Usuario $usuario, Erros $model): bool
    {
        return true;
    }

    /**
     * Determine whether the erros can delete the model.
     */
    public function delete(Usuario $usuario, Erros $model): bool
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
     * Determine whether the erros can restore the model.
     */
    public function restore(Usuario $usuario, Erros $model): bool
    {
        return false;
    }

    /**
     * Determine whether the erros can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Erros $model): bool
    {
        return false;
    }
}
