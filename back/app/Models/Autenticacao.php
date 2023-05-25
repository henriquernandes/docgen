<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autenticacao extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'tipo_autenticacao',
        'descricao',
        'corpo_envio_resposta_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'autenticacoes';

    public function corpoEnvioResposta()
    {
        return $this->belongsTo(CorpoEnvioResposta::class);
    }
}
