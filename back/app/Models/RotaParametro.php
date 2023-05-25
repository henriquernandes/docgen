<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RotaParametro extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['parametro', 'descricao', 'exemplo', 'rota_id'];

    protected $searchableFields = ['*'];

    protected $table = 'rota_parametros';

    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }
}
