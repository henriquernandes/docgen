<?php

namespace Database\Factories;

use App\Models\Projeto;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Projeto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url_padrao' => $this->faker->text(255),
            'empresa_id' => \App\Models\Empresa::factory(),
        ];
    }
}
