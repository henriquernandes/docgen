<?php

namespace Database\Seeders;

use App\Models\Erros;
use Illuminate\Database\Seeder;

class ErrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Erros::factory()
            ->count(5)
            ->create();
    }
}
