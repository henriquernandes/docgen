<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::factory()->state([
            'nome' => 'Docgen',
            'email' => 'docgen@docgen.com',
        ])->create();

        // Empresa::factory()
        //     ->count(5)
        //     ->create();
    }
}
