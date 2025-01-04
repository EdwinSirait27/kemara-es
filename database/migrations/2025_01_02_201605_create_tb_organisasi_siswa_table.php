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
        Schema::create('tb_organisasi_siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->unsignedBigInteger('organisasi_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->foreign('organisasi_id')->references('id')->on('tb_organisasi')->onDelete('set null'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_organisasi_siswa');
    }
};
