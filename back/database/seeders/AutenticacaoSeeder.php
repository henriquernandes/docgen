<?php

namespace Database\Seeders;

use App\Models\Autenticacao;
use Illuminate\Database\Seeder;

class AutenticacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autenticacao::factory()
            ->count(5)
            ->create();
    }
}
