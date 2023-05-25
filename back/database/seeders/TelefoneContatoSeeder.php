<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TelefoneContato;

class TelefoneContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TelefoneContato::factory()
            ->count(5)
            ->create();
    }
}
