<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Autenticacao;
use Illuminate\Auth\Access\HandlesAuthorization;

class AutenticacaoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the autenticacao can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the autenticacao can view the model.
     */
    public function view(Usuario $usuario, Autenticacao $model): bool
    {
        return true;
    }

    /**
     * Determine whether the autenticacao can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the autenticacao can update the model.
     */
    public function update(Usuario $usuario, Autenticacao $model): bool
    {
        return true;
    }

    /**
     * Determine whether the autenticacao can delete the model.
     */
    public function delete(Usuario $usuario, Autenticacao $model): bool
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
     * Determine whether the autenticacao can restore the model.
     */
    public function restore(Usuario $usuario, Autenticacao $model): bool
    {
        return false;
    }

    /**
     * Determine whether the autenticacao can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Autenticacao $model): bool
    {
        return false;
    }
}
