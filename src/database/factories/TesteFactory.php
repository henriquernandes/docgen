<?php

namespace Database\Factories;

use App\Models\Teste;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TesteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teste::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'passou' => $this->faker->boolean(),
            'retorno_erro' => $this->faker->text(255),
            'corpo_envio_resposta_id' => \App\Models\CorpoEnvioResposta::factory(),
        ];
    }
}
