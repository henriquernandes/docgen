<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teste extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['corpo_envio_resposta_id', 'passou', 'retorno_erro', 'rota_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'passou' => 'boolean',
    ];

    public function corpoEnvioResposta()
    {
        return $this->belongsTo(CorpoEnvioResposta::class);
    }

    public function allErros()
    {
        return $this->belongsToMany(Erros::class);
    }

    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }
}
