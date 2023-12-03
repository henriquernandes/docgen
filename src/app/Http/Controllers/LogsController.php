<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Teste;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LogsController extends Controller
{
    public function index(Request $request): Response
    {
        //testes where routes where projects where empresa_id = auth()->user()->empresa_id
        $testes = Teste::whereHas('rota', function ($query) use ($request) {
            $query->whereHas('projeto', function ($query) use ($request) {
                $query->where('empresa_id', $request->user()->empresa_id);
            });
        })
            ->with([
                'corpoEnvioResposta',
                'corpoEnvioResposta.metodo',
                'rota',
                'rota.projeto'
            ])
            ->orderBy('created_at', 'desc')
        ->get();

        return Inertia::render('Logs/Index', [
            'auth' => auth()->user(),
            'logs' => $testes,
        ]);
    }
}
