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
        Schema::table('corpo_envio_respostas', function (Blueprint $table) {
            $table
                ->foreign('metodo_id')
                ->references('id')
                ->on('metodos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('corpo_envio_respostas', function (Blueprint $table) {
            $table->dropForeign(['metodo_id']);
        });
    }
};
