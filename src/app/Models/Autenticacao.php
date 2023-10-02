<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Autenticacao extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'tipo_autenticacao',
        'descricao',
        'local_envio',
        'chave',
        'projeto_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'autenticacoes';

    public static function getAllAutenticoes(int $projeto_id): Collection
    {
        $routes = self::where('projeto_id', $projeto_id)->get();
        return $routes;
    }

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

}
