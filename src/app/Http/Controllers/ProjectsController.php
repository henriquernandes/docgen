<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjetoPostRequest;
use App\Http\Requests\ProjetoUpdateRequest;
use App\Models\Projeto;
use App\Models\Rota;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProjectsController extends Controller
{
    public function index(Request $request): Response
    {

        $projetos = Projeto::where('empresa_id', auth()->user()->empresa_id)->orderBy('id', 'desc')->get();

        return Inertia::render('Projects/Index', [
            'auth' => auth()->user(),
            'projetos' => $projetos,
        ]);
    }

    public function destroy(int $id): Response|RedirectResponse|JsonResponse
    {
        if (empty($id)) {
            return response()->json([
                "success" => false,
                "data" => [],
                "error" => "Nenhum projeto encontrado com o id informado"
            ]);
        }

        $projeto = new Projeto();
        $projeto = $projeto->findOrFail($id);

        if ($projeto->delete()) {
            return Redirect::route('projetos.index')->with('success', 'Projeto excluído com sucesso!');
        }

        return Inertia::render('Projects/Index', [
            'auth' => auth()->user(),
        ]);
    }

    public function store(ProjetoPostRequest $request): Response|RedirectResponse
    {
        $request->validated();
        $projeto = new Projeto();
        $projeto->fill($request->all());
        $projeto->empresa_id = auth()->user()->empresa_id;

        if ($projeto->save()) {
            return Redirect::route('projetos.index')->with('success', 'Projeto Criado com Sucesso!');
        }

        return Inertia::render('Projetos/Index', [
            'auth' => $request->user()
        ]);
    }

    public function update(ProjetoUpdateRequest $request, int $id): Response|RedirectResponse
    {
        $request->validated();
        $projeto = new Projeto();
        $projeto = $projeto->findOrFail($id);
        $projeto->fill($request->all());
        $projeto->empresa_id = auth()->user()->empresa_id;

        if ($projeto->save()) {
            return Redirect::route('projetos.index')->with('success', 'Projeto Atualizado com Sucesso!');
        }

        return Inertia::render('Projetos/Index', [
            'auth' => $request->user()
        ]);
    }
}
