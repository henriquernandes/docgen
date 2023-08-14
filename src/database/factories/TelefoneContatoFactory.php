<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TelefoneContato;
use Illuminate\Database\Eloquent\Factories\Factory;

class TelefoneContatoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TelefoneContato::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => \App\Models\Usuario::factory(),
        ];
    }
}
