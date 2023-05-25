<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metodo extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['corpo_json'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'corpo_json' => 'array',
    ];

    public function corpoEnvioRespostas()
    {
        return $this->hasMany(CorpoEnvioResposta::class);
    }

    public function allErros()
    {
        return $this->hasMany(Erros::class);
    }
}
