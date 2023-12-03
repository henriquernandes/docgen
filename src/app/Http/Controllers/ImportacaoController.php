<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportarRequest;
use App\Models\Importacao;
use Illuminate\Http\Request;

class ImportacaoController extends Controller
{
    public function importar(Request $request, $projeto_id)
    {
        if (empty($request->file('arquivo'))) {
            return redirect()->back()->with('error', 'Arquivo não enviado');
        }

        $arquivo = $request->file('arquivo');

        $extensao = $arquivo->getClientOriginalExtension();

        if ($extensao == 'json') {
            $data = json_decode(file_get_contents($arquivo->getRealPath()), true);
        }

        if ($extensao == 'yml' || $extensao == 'yaml') {
            $data = yaml_parse_file($arquivo->getRealPath());
        }

        if (empty($data)) {
            return redirect()->back()->with('error', 'Arquivo inválido');
        }

        Importacao::mountArray($data, $projeto_id);
    }
}
