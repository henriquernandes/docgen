<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Autenticacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutenticacaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Autenticacao::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_autenticacao' => $this->faker->text(255),
            'descricao' => $this->faker->text(255),
            'corpo_envio_resposta_id' => \App\Models\CorpoEnvioResposta::factory(),
        ];
    }
}
