<?php

namespace Database\Seeders;

use App\Models\Metodo;
use Illuminate\Database\Seeder;

class MetodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Metodo::factory()
            ->count(5)
            ->create();
    }
}
