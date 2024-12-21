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
        Schema::create('tb_datamengajar', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('matapelajaran_id')->nullable();
            $table->foreign('guru_id')->references('guru_id')->on('tb_guru')->onDelete('set null'); 
            $table->foreign('matapelajaran_id')->references('id')->on('tb_matapelajaran')->onDelete('set null'); 
            $table->string('hari')->nullable();
            $table->time('awalpel')->nullable();
            $table->time('akhirpel')->nullable();
            $table->time('awalis')->nullable();
            $table->time('akhiris')->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_datamengajar');
    }
};
