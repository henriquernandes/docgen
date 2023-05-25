<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TelefoneContato extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['usuario_id'];

    protected $searchableFields = ['*'];

    protected $table = 'telefone_contatos';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
