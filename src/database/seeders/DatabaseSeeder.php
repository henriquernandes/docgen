<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(AutenticacaoSeeder::class);
        // $this->call(CorpoEnvioRespostaSeeder::class);
        // $this->call(EmpresaSeeder::class);
        // $this->call(ErrosSeeder::class);
        $this->call(MetodoSeeder::class);
        // $this->call(ProjetoSeeder::class);
        // $this->call(RotaSeeder::class);
        // $this->call(RotaParametroSeeder::class);
        // $this->call(TelefoneContatoSeeder::class);
        // $this->call(TesteSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}
