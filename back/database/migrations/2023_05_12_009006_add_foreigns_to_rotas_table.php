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
        Schema::table('rotas', function (Blueprint $table) {
            $table
                ->foreign('projeto_id')
                ->references('id')
                ->on('projetos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rotas', function (Blueprint $table) {
            $table->dropForeign(['projeto_id']);
        });
    }
};
