<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\RotaParametro;
use Illuminate\Database\Eloquent\Factories\Factory;

class RotaParametroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RotaParametro::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parametro' => $this->faker->text(255),
            'descricao' => $this->faker->text(255),
            'exemplo' => $this->faker->text(255),
            'rota_id' => \App\Models\Rota::factory(),
        ];
    }
}
