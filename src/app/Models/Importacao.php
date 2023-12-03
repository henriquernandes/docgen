<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    use HasFactory;

    public static function mountArray($data, $projeto_id)
    {
        $array_formatado = [];
        if (isset($data['paths'])) {
            foreach ($data['paths'] as $nome_rota => $metodos) {
                foreach ($metodos as $metodo => $informacoes_rota) {
                    $metodo_id = Metodo::whereRaw('lower(metodo) ILIKE lower(?)', [$metodo])->first()->id;
                    $temp_id = uniqid();

                    $parametros = [];
                    if (isset($informacoes_rota['parameters'])) {
                        foreach ($informacoes_rota['parameters'] as $parametro) {
                            $parametros[] = [
                                'parametro' => isset($parametro['name']) ? $parametro['name'] : '',
                                'tipo' => isset($parametro['type']) ? $parametro['type'] : '',
                                'descricao' => isset($parametro['description']) ? $parametro['description'] : '',
                                'exemplo' => isset($parametro['type']) ? (!empty(self::mountJsonType($parametro['type'])) ?
                                    self::mountJsonType($parametro['type']) : 'Não informado') : 'Não informado',
                            ];
                        }
                    }

                    if (isset($informacoes_rota['security'])) {
                        $security = $informacoes_rota['security'][0];
                        $security = array_keys($security);
                        $security = $security[0];
                        $informacoes_rota['security'] = $security;
                    }

                    $rota_corpo = [];
                    if (!empty($informacoes_rota['parameters'])) {
                        foreach ($informacoes_rota['parameters'] as $parametro) {
                            if (isset($parametro['schema']['$ref'])) {
                                $ref = self::formatDefinitionToArray($parametro['schema']['$ref']);
                                $corpo_openapi = $data;
                                foreach ($ref as $key_ref) {
                                    $corpo_openapi = $corpo_openapi[$key_ref];
                                }
                                $obj = json_encode(self::mountJsonObject($corpo_openapi));
                            }
                            $rota_corpo[] = [
                                'metodo_id' => $metodo_id,
                                'temp_rota_id' => $temp_id,
                                'tipo_resposta' => false,
                                'corpo_json' => isset($obj) ? $obj : "{}",
                            ];
                        }
                    }

                    if(isset($informacoes_rota['requestBody'])) {
                        $requestBody = $informacoes_rota['requestBody'];
                        if(isset($requestBody['content']['application/json']['schema']['$ref'])) {
                            $ref = self::formatDefinitionToArray($requestBody['content']['application/json']['schema']['$ref']);
                            $corpo_openapi = $data;
                            foreach ($ref as $key_ref) {
                                $corpo_openapi = $corpo_openapi[$key_ref];
                            }
                            $obj = json_encode(self::mountJsonObject($corpo_openapi));
                        }
                        $rota_corpo[] = [
                            'metodo_id' => $metodo_id,
                            'temp_rota_id' => $temp_id,
                            'tipo_resposta' => false,
                            'corpo_json' => isset($obj) ? $obj : "{}",
                        ];
                    }

                    $respostas = [];
                    if (isset($informacoes_rota['responses'])) {
                        foreach ($informacoes_rota['responses'] as $key => $value) {
                            if(isset($requestBody['content']['application/json']['schema']['$ref'])) {
                                $ref = self::formatDefinitionToArray($requestBody['content']['application/json']['schema']['$ref']);
                                $corpo_openapi = $data;
                                foreach ($ref as $key_ref) {
                                    $corpo_openapi = $corpo_openapi[$key_ref];
                                }
                                $obj = json_encode(self::mountJsonObject($corpo_openapi));
                            }
                            $respostas[] = [
                                'metodo_id' => $metodo_id,
                                'temp_rota_id' => $temp_id,
                                'corpo_json' => isset($obj) ? $obj : "{}",
                                'codigo_http' => $key,
                                'tipo_resposta' => true,
                                'descricao' => isset($value['description']) ? $value['description'] : '',
                            ];
                        }
                    }

                    $array_formatado['rotas'][] = [
                        'temp_id' => $temp_id,
                        'titulo' => isset($informacoes_rota['summary']) ? $informacoes_rota['summary'] : $nome_rota,
                        'rota' => $nome_rota,
                        'descricao' => $informacoes_rota['description'] ?? '',
                        'metodo' => $metodo_id,
                        'rota_parametro' => $parametros,
                        'rota_corpo' => $rota_corpo,
                        'rota_resposta' => $respostas,
                        'autenticacao' => isset($informacoes_rota['security']) ? $informacoes_rota['security'] : null,
                    ];


                }
            }
        }

        if (isset($data['components']['securitySchemes'])) {
            foreach ($data['components']['securitySchemes'] as $key => $value) {
                $array_formatado['autenticacao'][] = [
                    'nome' => $key,
                    'tipo_autenticacao' => isset($value['type']) ? $value['type'] : '',
                    'descricao' => isset($value['description']) ? $value['description'] : '',
                    'chave' => isset($value['name']) ? $value['name'] : '',
                    'local_envio' => isset($value['in']) ? $value['in'] : '',
                ];
            }
        }

        if (isset($array_formatado['autenticacao'])) {
            foreach ($array_formatado['autenticacao'] as &$autenticacao) {
                $autenticacao['projeto_id'] = $projeto_id;
                $auth = Autenticacao::create($autenticacao);
                $autenticacao['id'] = $auth->id;
            }
        }

        $padLeft = 0;
        $padTop = 0;
        $column = 0;

        foreach ($array_formatado['rotas'] as $key => $rotas) {
            if ($key % 10 == 0) {
                $padLeft += $column == 0 ? 0 : $padLeft += 100;
                $padTop = 0;
                $column++;
            } else {
                $padTop += 50;
            }

            $rotas['posicao_x'] = $padLeft;
            $rotas['posicao_y'] = $padTop;
            $rotas['projeto_id'] = $projeto_id;


            if (isset($rotas['autenticacao'])) {
                foreach ($array_formatado['autenticacao'] as $auth) {
                    if ($auth['nome'] == $rotas['autenticacao']) {
                        $rotas['autenticacao_id'] = $auth['id'];
                    }
                }
            }

            $rota = Rota::create($rotas);
            $rota->temp_id = $rotas['temp_id'];
            $corpo = null;

            foreach ($rotas['rota_parametro'] as $parametro) {
                $parametro['rota_id'] = $rota->id;
                RotaParametro::create($parametro);
            }

            if (!empty($rotas['rota_corpo'])) {
                foreach ($rotas['rota_corpo'] as $corpo) {
                    if ($corpo['temp_rota_id'] == $rotas['temp_id'] && !empty($corpo['corpo_json'])) {
                        $corpo['rota_id'] = $rota->id;
                        $corpo['metodo_id'] = $rotas['metodo'];
                        $corpo['tipo_resposta'] = false;
                        $corpo = CorpoEnvioResposta::create($corpo);
                        $rota->corpoEnvioResposta()->attach($corpo);
                    } else {
                        $corpo = CorpoEnvioResposta::create([
                            'metodo_id' => $rotas['metodo'],
                            'rota_id' => $rota->id,
                            'tipo_resposta' => false,
                            'corpo_json' => '{}',
                        ]);
                        $rota->corpoEnvioResposta()->attach($corpo);
                    }
                }
            }else {
                $corpo = CorpoEnvioResposta::create([
                    'metodo_id' => $rotas['metodo'],
                    'rota_id' => $rota->id,
                    'tipo_resposta' => false,
                    'corpo_json' => '{}',
                ]);
                $rota->corpoEnvioResposta()->attach($corpo);
            }

            if (!empty($rotas['rota_resposta'])) {
                foreach ($rotas['rota_resposta'] as $resposta) {
                    if ($resposta['temp_rota_id'] == $rotas['temp_id'] && !empty($resposta['corpo_json'])) {
                        $resposta['rota_id'] = $rota->id;
                        $resposta['metodo_id'] = $rotas['metodo'];
                        $respostas['codigo_http'] = $resposta['codigo_http'];
                        $respostas['tipo_resposta'] = $resposta['tipo_resposta'];
                        $resposta = CorpoEnvioResposta::create($resposta);
                        $rota->corpoEnvioResposta()->attach($resposta);
                    } else {
                        $resposta = CorpoEnvioResposta::create([
                            'metodo_id' => $rotas['metodo'],
                            'rota_id' => $rota->id,
                            'corpo_json' => '{}',
                            'codigo_http' => $resposta['codigo_http'],
                            'tipo_resposta' => $resposta['tipo_resposta'],
                        ]);
                        $rota->corpoEnvioResposta()->attach($resposta);
                    }
                }
            }

        }
    }

    public static function mountJsonObject($obj)
    {

        $json = [];

        if (isset($obj['type']) && $obj['type'] == 'object' && isset($obj['properties'])) {
            foreach ($obj['properties'] as $key => $value) {
                if (isset($value['type'])) {
                    $json[$key] = self::mountJsonType($value['type']);
                }
            }
        }

        return $json;

    }

    public static function mountJsonType($type)
    {
        $json = null;
        switch ($type) {
            case 'string':
                $json = 'string';
                break;
            case 'integer':
                $json = 1;
                break;
            case 'number':
                $json = 1.1;
                break;
            case 'boolean':
                $json = true;
                break;
            case 'array':
                $json = [];
                break;
            case 'object':
                $json = [];
                break;
        }
        return $json;
    }

    public static function formatDefinitionToArray($ref)
    {
        $ref = str_replace('#/', '', $ref);
        $ref = explode('/', $ref);
        return $ref;
    }
}
