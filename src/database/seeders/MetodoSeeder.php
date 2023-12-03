<?php

namespace Database\Seeders;

use App\Models\Metodo;
use Illuminate\Database\Seeder;

class MetodoSeeder extends Seeder
{

    protected $metodos = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'PATCH',
        'OPTIONS',
        'HEAD',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->metodos as $metodo) {
            Metodo::create([
                'metodo' => $metodo,
            ]);
        }
    }
}
