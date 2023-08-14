<?php

namespace App\Http\Controllers;

use App\Http\Requests\RotaPostRequest;
use App\Http\Requests\RotaUpdateRequest;
use App\Models\Rota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RotasController extends Controller
{
    public function index(Request $request): Response
    {
        $rotas = Rota::getAllRotas(6);

        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => $rotas,
            'projeto_id' => 6,
        ]);
    }

    public function store(RotaPostRequest $request): Response|RedirectResponse
    {
        $request->validated();
        $rota = new Rota();
        $rota->fill($request->all());
        if ($rota->save()) {
            return Redirect::route('dashboard')->with('success', 'Rota criada com sucesso!');
        }

        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => Rota::getAllRotas(6),
        ]);
    }

    public function update(RotaUpdateRequest $request, int $id): Response|RedirectResponse
    {
        $request->validated();

        $rota = new Rota();
        $rota = $rota->findOrFail($id);

        if (empty($rota)) {
            return response()->json([
                "success" => false,
                "data" => [],
                "error" => "Nenhuma rota encontrada com os parâmetros informados"
            ]);
        }

        $rota->fill($request->all());

        if ($rota->update()) {
            return Redirect::route('dashboard')->with('success', 'Rota atualizada com sucesso!');
        }

        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => Rota::getAllRotas(6),
        ]);
    }

    public function destroy(int $id): Response|RedirectResponse
    {
        if (empty($id)) {
            return response()->json([
                "success" => false,
                "data" => [],
                "error" => "Nenhuma rota encontrada com os parâmetros informados"
            ]);
        }

        $rota = new Rota();
        $rota = Rota::findOrFail($id);

        if ($rota->delete()) {
            return Redirect::route('dashboard')->with('success', 'Rota excluída com sucesso!');
        }

        return Inertia::render('Dashboard/Index', [
            'auth' => auth()->user(),
            'rotas' => Rota::getAllRotas(6),
        ]);
    }
}
