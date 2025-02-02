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
        Schema::create('tb_berita', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('header')->nullable(); 
            $table->string('slug')->unique();
            $table->text('body')->nullable(); 
            $table->string('gambar1')->nullable(); 
            $table->string('gambar2')->nullable(); 
            $table->string('gambar3')->nullable(); 
            $table->string('gambar4')->nullable(); 
            $table->string('gambar5')->nullable(); 
            $table->string('gambar6')->nullable(); 
            $table->string('gambar7')->nullable(); 
            $table->string('gambar8')->nullable(); 
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_berita');
    }
};
