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
        Schema::table('rota_corpo', function (Blueprint $table) {
            $table
                ->foreign('corpo_id')
                ->references('id')
                ->on('corpo_envio_respostas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

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
        Schema::table('rota_corpo', function (Blueprint $table) {
            $table->dropForeign(['corpo_id']);
            $table->dropForeign(['rota_id']);
        });
    }
};
