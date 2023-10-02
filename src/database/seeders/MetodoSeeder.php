<?php

namespace Database\Seeders;

use App\Models\Metodo;
use Illuminate\Database\Seeder;

class MetodoSeeder extends Seeder
{

    protected $metodos = [
        'get',
        'post',
        'put',
        'patch',
        'delete',
        'options',
        'head',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->metodos as $metodo) {
            Metodo::factory()->create([
                'metodo' => $metodo,
            ]);
        }
    }
}
