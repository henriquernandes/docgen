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
        Schema::create('rota_parametros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parametro');
            $table->string('descricao');
            $table->string('exemplo');
            $table->unsignedBigInteger('rota_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rota_parametros');
    }
};
