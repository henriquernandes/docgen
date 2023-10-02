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

    protected $fillable = ['titulo', 'rota', 'descricao', 'projeto_id', 'posicao_x', 'posicao_y', 'autenticacao_id'];

    protected $searchableFields = ['*'];

    public static function getAllRotas(int $projeto_id, $withResponse = false): Collection
    {
        $routes = self::where('projeto_id', $projeto_id)->with([
            'corpoEnvioResposta' => function ($query) use ($withResponse) {
                if ($withResponse) {
                    $query->where('tipo_resposta', true);
                } else {
                    $query->where('tipo_resposta', false);
                }
            },
            'corpoEnvioResposta.metodo',
            'autenticacao',
            'rotaParametros'])->get();
        return $routes;
    }

    public function autenticacao()
    {
        return $this->belongsTo(Autenticacao::class);
    }

    public function rotaParametros()
    {
        return $this->hasMany(RotaParametro::class, 'rota_id', 'id');
    }

    public function projeto()
    {
        return $this->belongsToMany(Projeto::class, 'usuario_projetos');
    }

    public function corpoEnvioResposta()
    {
        return $this->belongsToMany(CorpoEnvioResposta::class, 'rota_corpo', 'rota_id', 'corpo_id');
    }
}
