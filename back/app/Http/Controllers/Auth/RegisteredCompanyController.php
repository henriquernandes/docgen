<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisteredCompanyController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email', 'unique:empresas,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'empresa_nome' => ['required', 'string', 'max:255'],
            'empresa_email' => ['required', 'string', 'email', 'max:14', 'unique:usuarios,email', 'unique:empresas,email'],
            'cnpj' => ['required', 'string', 'max:255', 'unique:empresas,cnpj'],
        ]);
        $empresa = new Empresa();
        $empresa = $empresa->createNewEmpresa($request);

        $user = new Usuario();
        $user = $user->fill([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
            'empresa_id' => $empresa->id
        ])->createUsuarioComEmpresa();

        $empresa->refresh();
        $empresa->usuario_id = $user->id;
        $empresa->save();

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
