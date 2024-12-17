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
        Schema::create('tb_matapelajaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true)->nullable()->primary();
            $table->string('matapelajaran')->nullable();
            $table->string('kkm')->nullable();
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
        Schema::dropIfExists('tb_matapelajaran');
    }
};
