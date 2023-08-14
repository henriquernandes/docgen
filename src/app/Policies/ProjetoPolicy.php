<?php

namespace App\Policies;

use App\Models\Projeto;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjetoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the projeto can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the projeto can view the model.
     */
    public function view(Usuario $usuario, Projeto $model): bool
    {
        return true;
    }

    /**
     * Determine whether the projeto can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the projeto can update the model.
     */
    public function update(Usuario $usuario, Projeto $model): bool
    {
        return true;
    }

    /**
     * Determine whether the projeto can delete the model.
     */
    public function delete(Usuario $usuario, Projeto $model): bool
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
     * Determine whether the projeto can restore the model.
     */
    public function restore(Usuario $usuario, Projeto $model): bool
    {
        return false;
    }

    /**
     * Determine whether the projeto can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Projeto $model): bool
    {
        return false;
    }
}
