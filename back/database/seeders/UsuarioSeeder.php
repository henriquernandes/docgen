<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::factory()->state([
            'nome' => 'Docgen',
            'email' => 'docgen@docgen.com',
            'password' => bcrypt('docgen'),
        ])->create();

        Usuario::factory()
            ->count(5)
            ->create();
    }
}
