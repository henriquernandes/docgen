<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('autenticacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_autenticacao');
            $table->string('descricao');
            $table->unsignedBigInteger('corpo_envio_resposta_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autenticacoes');
    }
};
