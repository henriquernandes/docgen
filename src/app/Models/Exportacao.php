<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exportacao extends Model
{
    use HasFactory;

    public static function exportacao($projeto_id)
    {
        $rotas = Rota::getAllRotas($projeto_id, true);
        $autenticacoes = Autenticacao::where('projeto_id', $projeto_id)->get();
        $projeto = Projeto::where('id', $projeto_id)->first();

        $data = [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'Documentação da API '. $projeto->titulo,
                'description' => 'Documentação da API '. $projeto->titulo,
                'version' => '1.0.0',
            ],
            'servers' => [
                [
                    'url' => $projeto->url_padrao,
                    'description' => 'Servidor Local'
                ]
            ],
            'paths' => [],
            'securityDefinitions' => []
        ];
        foreach ($rotas as $rota) {
            $nome_rota = str_replace('\/', '/', $rota->rota);

            $metodo = isset($rota->corpoEnvioResposta[0]->metodo_id) ? Metodo::find($rota->corpoEnvioResposta[0]->metodo_id)->metodo : '';

            $parameters = [];
            $rota_parametros = RotaParametro::where('rota_id', $rota->id)->get();
            foreach ($rota_parametros as $parametro) {
                $parameters[] = [
                    'name' => $parametro->parametro,
                    'in' => $parametro->parametro === 'body' ? 'body' : (str_contains($nome_rota, $parametro->parametro) ? 'path' : 'formData'),
                    'description' => $parametro->descricao,
                    'required' => true,
                ];
            }

            $corpo = $rota->corpoEnvioResposta()->where('tipo_resposta', false)->first();
            $requestBody = null;
            if ($corpo && !empty($corpo->corpo_json)) {
                $requestBody = [
                    'content' => [
                        'application/json' => [
                            'schema' => self::generateSchema(json_decode($corpo->corpo_json)),
                        ]
                    ]
                ];
            }

            $response = [];
            $responseItems = $rota->corpoEnvioResposta()->where('tipo_resposta')->get();
            if ($responseItems) {
                foreach ($responseItems as $res) {
                    $responseBody = [
                        'description' => $res->codigo_http,
                        'content' => [
                            'application/json' => [
                                'schema' => self::generateSchema(json_decode($res->corpo_json, true)),
                            ]
                        ]
                    ];
                    $response[$res->codigo_http] = $responseBody;
                }
            }

            $data['paths'][$nome_rota][$metodo]['responses'] = $response;

            $security = null;
            if ($rota->autenticacao_id) {
                $autenticacao = Autenticacao::find($rota->autenticacao_id);
                $security = [
                    [
                        $autenticacao->nome => []
                    ]
                ];
            }

            $data['paths'][$nome_rota][$metodo] = [
                'summary' => $rota->titulo,
                'description' => $rota->descricao,
                'parameters' => $parameters,
                'requestBody' => $requestBody,
                'responses' => $response,
            ];

            if ($security !== null) {
                $data['paths'][$nome_rota][$metodo]['security'] = $security;
            }
        }

        foreach ($autenticacoes as $autenticacao) {
            $data['securityDefinitions'][$autenticacao->nome] = [
                'type' => $autenticacao->tipo_autenticacao,
                'description' => $autenticacao->descricao,
                'name' => $autenticacao->chave,
                'in' => $autenticacao->local_envio
            ];
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return $json;
    }

    public static function convertJsonToType($json)
    {
        $type = null;
        if (is_string($json)) {
            $type = 'string';
        } elseif (is_int($json)) {
            $type = 'integer';
        } elseif (is_float($json)) {
            $type = 'number';
        } elseif (is_bool($json)) {
            $type = 'boolean';
        } elseif (is_array($json)) {
            $type = 'array';
        } elseif (is_object($json)) {
            $type = 'object';
        }
        return $type;
    }

    public static function generateSchema($json)
    {
        $schema = null;
        $type = self::convertJsonToType($json);

        if ($type === 'array') {
            $schema = [
                'type' => 'array',
                'items' => self::generateSchema(reset($json))
            ];
        } elseif ($type === 'object') {
            $properties = [];
            foreach ($json as $key => $value) {
                $properties[$key] = self::generateSchema($value);
            }
            $schema = [
                'type' => 'object',
                'properties' => $properties
            ];
        } else {
            $schema = [
                'type' => $type
            ];
        }

        if (!is_array($schema)) {
            $schema = [
                'type' => 'string',
                'example' => $schema
            ];
        }

        return $schema;
    }

}
