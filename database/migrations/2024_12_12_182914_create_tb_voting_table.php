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
        Schema::create('tb_voting', function (Blueprint $table) {
            $table->BigInteger('id', true)->nullable();
            $table->foreign('osis_id')->references('id')->on('tb_osis')->onDelete('set null'); 
            $table->BigInteger('osis_id')->nullable(); 
            $table->string('jumlahsuara')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_voting');
    }
};
