<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CorpoEnvioResposta extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['metodo_id'];

    protected $searchableFields = ['*'];

    protected $table = 'corpo_envio_respostas';

    public function autenticacao()
    {
        return $this->hasOne(Autenticacao::class);
    }

    public function metodo()
    {
        return $this->belongsTo(Metodo::class);
    }

    public function testes()
    {
        return $this->hasMany(Teste::class);
    }
}
