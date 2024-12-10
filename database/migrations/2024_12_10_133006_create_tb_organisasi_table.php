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
        Schema::create('tb_organisasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->nullable();
            $table->string('namaorganisasi')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->enum('status',['Aktif','Tidak Aktif'])->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_organisasi');
    }
};