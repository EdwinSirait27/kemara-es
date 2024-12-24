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
        Schema::create('tb_pengaturan_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('tahunakademik_id')->nullable();
            $table->string('ket')->nullable();
            $table->foreign('kelas_id')->references('id')->on('tb_kelas')->onDelete('set null'); 
            $table->foreign('tahunakademik_id')->references('id')->on('tb_tahunakademik')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengaturan_kelas');
    }
};
