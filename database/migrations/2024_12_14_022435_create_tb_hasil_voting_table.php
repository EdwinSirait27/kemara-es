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
        Schema::create('tb_hasil_voting', function (Blueprint $table) {
            $table->BigInteger('id', true)->nullable();
            $table->BigInteger('osis_id')->nullable(); 
            $table->foreign('osis_id')->references('id')->on('tb_osis')->onDelete('set null'); 
            $table->string('jumlahsuara')->nullable(); 
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_hasil_voting');
    }
};