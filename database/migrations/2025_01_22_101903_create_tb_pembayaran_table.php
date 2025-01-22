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
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->primary();
$table->unsignedBigInteger('siswa_id')->nullable();
$table->foreign('siswa_id')->references('siswa_id')->on('tb_siswa')->onDelete('set null'); 

$table->enum('status', ['Menunggu Pembayaran', 'Dalam Antrian','Lunas'])->nullable();
$table->string('foto')->nullable();
$table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pembayaran');
    }
};
