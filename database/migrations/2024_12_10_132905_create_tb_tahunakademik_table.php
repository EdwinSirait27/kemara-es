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
        Schema::create('tb_tahunakademik', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->nullable();
            $table->integer('tahunakademik')->nullable();
            $table->enum('semester',['Ganjil','Genap'])->nullable();
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
        Schema::dropIfExists('tb_tahunakademik');
    }
};
