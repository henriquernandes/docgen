<?php

namespace Database\Seeders;

use App\Models\RotaParametro;
use Illuminate\Database\Seeder;

class RotaParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RotaParametro::factory()
            ->count(5)
            ->create();
    }
}
