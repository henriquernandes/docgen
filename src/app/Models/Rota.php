<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Rota extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['titulo', 'rota', 'descricao', 'projeto_id'];

    protected $searchableFields = ['*'];

    public static function getAllRotas(int $projeto_id): Collection
    {
        $routes = self::where('projeto_id', $projeto_id)->get();
        return $routes;
    }

    public function rotaParametros()
    {
        return $this->hasMany(RotaParametro::class);
    }

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id', 'id');
    }
}
