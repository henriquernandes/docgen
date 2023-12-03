<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = ['nome', 'email', 'password', 'matricula', 'empresa_id'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['empresa'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function telefoneContatoes()
    {
        return $this->hasMany(TelefoneContato::class);
    }

    public function projetos()
    {
        return $this->belongsToMany(Projeto::class, 'usuario_projetos');
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->email, config('auth.super_admins'));
    }



    public function whichCadastroShouldUse()
    {
        if ($this->empresa_id == null) {
            return self::createUsuarioSemEmpresa();
        } else {
            return self::createUsuarioComEmpresa();
        }
    }

    public function createUsuarioSemEmpresa()
    {
        $empresa = Empresa::createNewEmpresaFromNewUsario($this);

        $usuario = Usuario::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'matricula' => $this->matricula,
            'password' => Hash::make($this->password),
            'empresa_id' => $empresa->id,
        ]);

        return $usuario;
    }

    public function createUsuarioComEmpresa()
    {
        var_dump($this);
        $usuario = Usuario::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'matricula' => $this->matricula,
            'password' => Hash::make($this->password),
            'empresa_id' => $this->empresa_id,
        ]);

        return $usuario;
    }

    public function getEmpresaAttribute()
    {
        return $this->empresa()->first();
    }
}
