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
        Schema::table('testes', function (Blueprint $table) {
            $table->text('retorno_erro')->nullable()->change();
            $table->foreignId('rota_id')->nullable()->constrained('rotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testes', function (Blueprint $table) {
            $table->string('retorno_erro')->change();
            $table->dropForeign('testes_rota_id_foreign');
            $table->dropColumn('rota_id');
        });
    }
};
