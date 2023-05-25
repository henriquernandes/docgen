<?php

namespace Database\Factories;

use App\Models\Erros;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ErrosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Erros::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'corpo_json' => [],
            'descricao' => $this->faker->text(255),
            'titulo' => $this->faker->text(255),
            'metodo_id' => \App\Models\Metodo::factory(),
        ];
    }
}
