<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CorpoEnvioResposta;
use Illuminate\Database\Eloquent\Factories\Factory;

class CorpoEnvioRespostaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CorpoEnvioResposta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'metodo_id' => \App\Models\Metodo::factory(),
            'corpo_json' => json_encode(['test' => 'test']),
        ];
    }
}
