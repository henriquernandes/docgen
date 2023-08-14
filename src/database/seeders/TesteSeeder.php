<?php

namespace Database\Seeders;

use App\Models\Teste;
use Illuminate\Database\Seeder;

class TesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teste::factory()
            ->count(5)
            ->create();
    }
}
