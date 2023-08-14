<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\CorpoEnvioResposta;
use Illuminate\Auth\Access\HandlesAuthorization;

class CorpoEnvioRespostaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the corpoEnvioResposta can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the corpoEnvioResposta can view the model.
     */
    public function view(Usuario $usuario, CorpoEnvioResposta $model): bool
    {
        return true;
    }

    /**
     * Determine whether the corpoEnvioResposta can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the corpoEnvioResposta can update the model.
     */
    public function update(Usuario $usuario, CorpoEnvioResposta $model): bool
    {
        return true;
    }

    /**
     * Determine whether the corpoEnvioResposta can delete the model.
     */
    public function delete(Usuario $usuario, CorpoEnvioResposta $model): bool
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
     * Determine whether the corpoEnvioResposta can restore the model.
     */
    public function restore(Usuario $usuario, CorpoEnvioResposta $model): bool
    {
        return false;
    }

    /**
     * Determine whether the corpoEnvioResposta can permanently delete the model.
     */
    public function forceDelete(
        Usuario $usuario,
        CorpoEnvioResposta $model
    ): bool {
        return false;
    }
}
