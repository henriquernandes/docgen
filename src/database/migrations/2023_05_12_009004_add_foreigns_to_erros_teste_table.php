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
        Schema::table('erros_teste', function (Blueprint $table) {
            $table
                ->foreign('erros_id')
                ->references('id')
                ->on('erros')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('teste_id')
                ->references('id')
                ->on('testes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('erros_teste', function (Blueprint $table) {
            $table->dropForeign(['erros_id']);
            $table->dropForeign(['teste_id']);
        });
    }
};
