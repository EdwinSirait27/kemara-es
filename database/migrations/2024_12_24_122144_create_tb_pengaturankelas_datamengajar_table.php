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
        Schema::create('tb_pengaturankelas_datamengajar', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->unsignedBigInteger('datamengajar_id')->nullable();
            $table->unsignedBigInteger('pengaturankelas_id')->nullable();
            $table->foreign('datamengajar_id')->references('id')->on('tb_datamengajar')->onDelete('set null'); 
            $table->foreign('pengaturankelas_id')->references('id')->on('tb_pengaturan_kelas')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengaturankelas_datamengajar');
    }
};
