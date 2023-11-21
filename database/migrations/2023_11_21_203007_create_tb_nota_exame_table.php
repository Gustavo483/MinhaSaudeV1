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
        Schema::create('tb_nota_exame', function (Blueprint $table) {
            $table->id('id_notaExame');
            $table->unsignedBigInteger('id_exame');
            $table->foreign('id_exame')->references('id_exame')->on('tb_exames');
            $table->string('st_nomeNota');
            $table->longText('st_descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nota_exame');
    }
};
