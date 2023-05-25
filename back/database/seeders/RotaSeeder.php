<?php

namespace Database\Seeders;

use App\Models\Rota;
use Illuminate\Database\Seeder;

class RotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rota::factory()
            ->count(5)
            ->create();
    }
}
