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
        Schema::create('tb_osis', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->foreign('siswa_id')->references('siswa_id')->on('tb_siswa')->onDelete('set null'); 
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_osis');
    }
};
