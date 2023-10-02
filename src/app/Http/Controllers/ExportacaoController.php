<?php

namespace App\Http\Controllers;

use App\Models\Exportacao;
use Illuminate\Support\Facades\File;

class ExportacaoController extends Controller
{
    public function exportar(int $projeto_id)
    {
        $json = Exportacao::exportacao($projeto_id);

        $file = storage_path('app/public/doc.json');

        File::put($file, $json);

        return response()->download($file, 'doc.json');
    }
}
