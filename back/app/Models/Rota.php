<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rota extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['titulo', 'rota', 'descricao', 'projeto_id'];

    protected $searchableFields = ['*'];

    public function rotaParametros()
    {
        return $this->hasMany(RotaParametro::class);
    }

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }
}
