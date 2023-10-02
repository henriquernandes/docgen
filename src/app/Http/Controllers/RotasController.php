<?php

namespace App\Http\Controllers;

use App\Http\Requests\RotaPostRequest;
use App\Http\Requests\RotaUpdateRequest;
use App\Models\Autenticacao;
use App\Models\CorpoEnvioResposta;
use App\Models\Metodo;
use App\Models\Rota;
use App\Models\RotaParametro;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RotasController extends Controller
{
    public function index(Request $request, int $projeto_id): Response
    {
        $rotas = Rota::getAllRotas($projeto_id);

        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => $rotas,
            'autenticacoes' => Autenticacao::getAllAutenticoes($projeto_id),
            'projeto_id' => $projeto_id,
        ]);
    }

    public function store(RotaPostRequest $request): Response|RedirectResponse
    {
        $request->validated();
        $rota = new Rota();
        $rota->fill($request->all());

        if ($rota->save()) {
            foreach($request->corpo_envio_resposta as $corpo){
                $corpo_data = CorpoEnvioResposta::findOrNew(isset($corpo['id']) ? $corpo['id'] : null);
                $corpo_data->metodo_id = isset($corpo['metodo']['metodo']) ? Metodo::where('metodo', $corpo['metodo']['metodo'])->first()->id : Metodo::where('metodo', 'GET')->first()->id;
                $corpo_data->corpo_json = $corpo['corpo_json'];
                $corpo_data->save();
                $rota->corpoEnvioResposta()->attach($corpo_data);
            }
            return Redirect::route("dashboard", $rota->projeto_id)->with('success', 'Rota criada com sucesso!');
        }

        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => Rota::getAllRotas($rota->projeto_id),
        ]);
    }

    public function update(RotaUpdateRequest $request, int $id): Response|RedirectResponse|JsonResponse
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
        foreach($request->corpo_envio_resposta as $corpo){
            $corpo_data = CorpoEnvioResposta::findOrNew(isset($corpo['id']) ? $corpo['id'] : null);
            $corpo_data->metodo_id = isset($corpo['metodo']['metodo']) ? Metodo::where('metodo', $corpo['metodo']['metodo'])->first()->id : Metodo::where('metodo', 'GET')->first()->id;
            $corpo_data->corpo_json = $corpo['corpo_json'];
            $corpo_data->save();
            $rota->corpoEnvioResposta()->attach($corpo_data);
        }

        $rota->rotaParametros()->delete();

        foreach ($request->rota_parametros as $parametro) {
            $parametro_data = RotaParametro::findOrNew(isset($parametro['id']) ? $parametro['id'] : null);
            $parametro_data->rota_id = $rota->id;
            $parametro_data->parametro = $parametro['parametro'];
            $parametro_data->descricao = $parametro['descricao'];
            $parametro_data->exemplo = $parametro['exemplo'];
            $parametro_data->save();
        }

        if(!isset($request->autenticacao['id']) && !empty($request->autenticacao)){
            Autenticacao::create($request->autenticacao);
            $rota->autenticacao_id = $request->autenticacao['id'];
        }

        if ($rota->save()) {
            return Redirect::route("dashboard", $rota->projeto_id)->with('success', 'Rota atualizada com sucesso!');
        }

        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => Rota::getAllRotas($rota->projeto_id),
        ]);
    }

    public function destroy(int $id): Response|RedirectResponse|JsonResponse
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

        foreach($rota->corpoEnvioResposta as $corpo){
            $corpo->delete();
        }

        if ($rota->delete()) {
            return Redirect::route("dashboard", $rota->projeto_id)->with('success', 'Rota excluída com sucesso!');
        }

        return Inertia::render('Dashboard/Index', [
            'auth' => auth()->user(),
            'rotas' => Rota::getAllRotas($rota->projeto_id),
        ]);
    }

    public function atualizarPosicoes(Request $request, Rota $rota): RedirectResponse
    {
        $rota->posicao_x = request('posicao_x');
        $rota->posicao_y = request('posicao_y');
        $rota->save();

        return Redirect::route('dashboard', [
            'auth' => $request->user(),
            'rotas' => Rota::getAllRotas($rota->projeto_id),
            'projeto_id' => $rota->projeto_id,
        ]);
    }
}
