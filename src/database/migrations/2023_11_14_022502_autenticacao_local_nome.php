<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('autenticacoes', function (Blueprint $table) {
            $table->dropColumn('corpo_envio_resposta_id');
            $table->string('local_envio')->nullable();
            $table->string('chave')->nullable();
            $table->foreignId('projeto_id')->constrained('projetos');
            $table->string('exemplo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('autenticacoes', function (Blueprint $table) {
            $table->dropColumn('local_envio');
            $table->dropColumn('chave');
            $table->foreignId('corpo_envio_resposta_id')->nullable()->constrained('corpo_envio_respostas');
            $table->dropColumn('projeto_id');
            $table->dropColumn('exemplo');
        });
    }
};
