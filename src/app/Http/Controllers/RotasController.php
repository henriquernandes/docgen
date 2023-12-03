<?php

namespace App\Http\Controllers;

use App\Http\Requests\RotaPostRequest;
use App\Http\Requests\RotaUpdateRequest;
use App\Models\Autenticacao;
use App\Models\CorpoEnvioResposta;
use App\Models\Metodo;
use App\Models\Projeto;
use App\Models\Rota;
use App\Models\RotaParametro;
use App\Models\Teste;
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
            'metodos' => Metodo::all(),
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

        dd(Metodo::get());
        return Inertia::render('Dashboard/Index', [
            'auth' => $request->user(),
            'rotas' => Rota::getAllRotas($rota->projeto_id),
            'metodos' => Metodo::all(),
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
        $rota->descricao = $request->descricao ? $request->descricao : "";

        $rota->corpoEnvioResposta()->detach();
        foreach($request->corpo_envio_resposta as $corpo){
            // dd($corpo);
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
            $parametro_data->descricao = $parametro['descricao'] ? $parametro['descricao'] : "";
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
            'metodos' => Metodo::all(),
            'metodos' => Metodo::all(),
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
            'metodos' => Metodo::all(),
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
            'metodos' => Metodo::all(),
            'projeto_id' => $rota->projeto_id,
        ]);
    }

    public function testes (Request $request, int $projeto_id)
    {

        $projeto = Projeto::where('id', $projeto_id)->first();
        $rotas = Rota::where('projeto_id', $projeto_id)->with('corpoEnvioResposta',
        'corpoEnvioResposta.metodo',
        'autenticacao',
        'rotaParametros'
        )->get();

        if(empty($rotas)){
            return response()->json([
                "success" => false,
                "data" => [],
                "error" => "Nenhuma rota encontrada com os parâmetros informados"
            ]);
        }

        foreach($rotas as $rota){
            $metodo = $rota->corpoEnvioResposta->where('tipo_resposta', false)->first()->metodo;
            $corpo = $rota->corpoEnvioResposta->where('tipo_resposta', false)->first();

            $client = new \GuzzleHttp\Client();

            $rota_uri = $rota->rota;

            if(strpos($rota_uri, '{') !== false){
                foreach($rota->rotaParametros as $parametro){
                    if($parametro->parametro === str_replace(['{', '}'], '', $parametro->parametro)){
                        $rota_uri = str_replace($parametro->parametro, $parametro->exemplo, $rota_uri);
                        $rota_uri = str_replace(['{', '}'], '', $rota_uri);
                    }
                }
            }
            try {
                $res = $client->request($metodo->metodo, $projeto->url_padrao.$rota_uri, [
                    'json' => $corpo->corpo_json ? $corpo->corpo_json : null,
                ]);
                $body = $res->getBody()->getContents();
                $corpo_resposta = CorpoEnvioResposta::create([
                    'metodo_id' => $metodo->id,
                    'corpo_json' => $body ? $body : 'Sem informação',
                    'codigo_http' => $res->getStatusCode(),
                    'tipo_resposta' => true
                ]);

                Teste::create([
                    'corpo_envio_resposta_id' => $corpo_resposta->id,
                    'passou' => $res->getStatusCode() > 200 && $res->getStatusCode() < 300 ? true : false,
                    'rota_id' => $rota->id,
                ]);

            } catch (\Throwable $th) {
                $corpo_resposta = CorpoEnvioResposta::create([
                    'metodo_id' => $metodo->id,
                    'corpo_json' => !empty($th->getMessage()) ? $th->getMessage() : 'Sem informação',
                    'codigo_http' => $th->getCode(),
                    'tipo_resposta' => true
                ]);
                Teste::create([
                    'corpo_envio_resposta_id' => $corpo_resposta->id,
                    'passou' => false,
                    'rota_id' => $rota->id,
                    'retorno_erro' => $th->getMessage()
                ]);
            }




        }


    }
}
