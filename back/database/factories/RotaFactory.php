<?php

namespace Database\Factories;

use App\Models\Rota;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rota::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->text(255),
            'rota' => $this->faker->text(255),
            'descricao' => $this->faker->text(255),
            'projeto_id' => \App\Models\Projeto::factory(),
        ];
    }
}
