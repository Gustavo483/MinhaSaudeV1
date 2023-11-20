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
        Schema::create('tb_arquivos', function (Blueprint $table) {
            $table->id('id_arquivo');
            $table->unsignedBigInteger('id_exame');
            $table->foreign('id_exame')->references('id_exame')->on('tb_exames');
            $table->string('fl_arquivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_arquivos');
    }
};
