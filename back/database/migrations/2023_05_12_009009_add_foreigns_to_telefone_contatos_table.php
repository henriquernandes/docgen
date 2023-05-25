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
        Schema::table('telefone_contatos', function (Blueprint $table) {
            $table
                ->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telefone_contatos', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
        });
    }
};
