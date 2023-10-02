<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nome', 'email', 'cnpj'];

    protected $searchableFields = ['*'];

    protected $appends = ['projetos'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    public function projetos()
    {
        return $this->hasMany(Projeto::class, 'empresa_id', 'id');
    }

    public static function createNewEmpresa($request){
        $empresa = Empresa::create([
            'nome' => $request->empresa_nome,
            'email' => $request->empresa_email,
            'cnpj' => $request->cnpj,
        ]);
        return $empresa;
    }

    public static function createNewEmpresaFromNewUsario($request){
        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);
        return $empresa;
    }

    public function getProjetosAttribute()
    {
        return $this->projetos()->get();
    }
}
