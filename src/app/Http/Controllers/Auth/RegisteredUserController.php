<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . Usuario::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email_empresa' => 'nullable|string|email|max:255|exists:empresas,email',
        ]);

        $user = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'empresa_id' => $request->email_empresa ? Empresa::where('email', $request->email_empresa)->first()->id : null,
        ]);

        if(empty($request->email_empresa)){
            $empresa = Empresa::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'usuario_id' => $user->id,
            ]);

            $user->empresa_id = $empresa->id;
            $user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
