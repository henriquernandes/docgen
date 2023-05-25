<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empresa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->text(255),
            'email' => $this->faker->email(),
            'cnpj' => $this->faker->numerify('##############'),
        ];
    }
}
