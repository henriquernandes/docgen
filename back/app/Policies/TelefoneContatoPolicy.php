<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\TelefoneContato;
use Illuminate\Auth\Access\HandlesAuthorization;

class TelefoneContatoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the telefoneContato can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the telefoneContato can view the model.
     */
    public function view(Usuario $usuario, TelefoneContato $model): bool
    {
        return true;
    }

    /**
     * Determine whether the telefoneContato can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the telefoneContato can update the model.
     */
    public function update(Usuario $usuario, TelefoneContato $model): bool
    {
        return true;
    }

    /**
     * Determine whether the telefoneContato can delete the model.
     */
    public function delete(Usuario $usuario, TelefoneContato $model): bool
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
     * Determine whether the telefoneContato can restore the model.
     */
    public function restore(Usuario $usuario, TelefoneContato $model): bool
    {
        return false;
    }

    /**
     * Determine whether the telefoneContato can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, TelefoneContato $model): bool
    {
        return false;
    }
}
