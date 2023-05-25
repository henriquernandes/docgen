<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CorpoEnvioResposta;

class CorpoEnvioRespostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CorpoEnvioResposta::factory()
            ->count(5)
            ->create();
    }
}
