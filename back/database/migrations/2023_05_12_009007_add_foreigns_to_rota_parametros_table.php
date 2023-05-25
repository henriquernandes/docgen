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
        Schema::table('rota_parametros', function (Blueprint $table) {
            $table
                ->foreign('rota_id')
                ->references('id')
                ->on('rotas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rota_parametros', function (Blueprint $table) {
            $table->dropForeign(['rota_id']);
        });
    }
};
