<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CorpoEnvioResposta extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['metodo_id', 'corpo_json', 'codigo_http', 'tipo_resposta'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'corpo_json' => 'array',
    ];

    protected $table = 'corpo_envio_respostas';

    public function metodo()
    {
        return $this->belongsTo(Metodo::class);
    }

    public function testes()
    {
        return $this->hasMany(Teste::class);
    }

    public function rota()
    {
        return $this->belongsToMany(Rota::class, 'rota_corpo', 'corpo_id', 'rota_id');
    }
}
