<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projeto extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['titulo', 'limite_usuarios', 'url_padrao', 'empresa_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function rotas()
    {
        return $this->hasMany(Rota::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_projetos');
    }

    public function autenticacoes()
    {
        return $this->hasMany(Autenticacao::class);
    }
}
