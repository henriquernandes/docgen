<?php

namespace Database\Factories;

use App\Models\Metodo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Metodo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'corpo_json' => [],
        ];
    }
}
