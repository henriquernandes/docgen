<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Erros extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['corpo_json', 'descricao', 'metodo_id', 'titulo'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'corpo_json' => 'array',
    ];

    public function metodo()
    {
        return $this->belongsTo(Metodo::class);
    }

    public function testes()
    {
        return $this->belongsToMany(Teste::class);
    }
}
