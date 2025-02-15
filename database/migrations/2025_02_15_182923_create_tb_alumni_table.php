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
        Schema::create('tb_alumni', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->string('foto')->nullable();
            $table->string('NamaLengkap')->nullable();
            $table->enum('JenisKelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->enum('Agama', ['Katolik', 'Kristen Protestan','Hindu','Buddha','Islam','Konghucu'])->nullable();
            $table->text('Alamat')->nullable();
            $table->string('Email')->nullable();
            $table->string('NomorTelephone')->nullable();
            $table->year('TahunLulus')->nullable();
            $table->string('Jurusan')->nullable();
            $table->string('ProgramStudi')->nullable();
            $table->enum('Gelar', ['D1', 'D2','D3','D4','S1','S2','Prof','Tidak Ada'])->nullable();
            $table->string('PerguruanTinggi')->nullable();
            $table->enum('StatusPekerja', ['Bekerja', 'Wirausaha','Belum Bekerja'])->nullable();
            $table->string('NamaPerusahaan')->nullable();
            $table->string('Ig')->nullable();
            $table->string('Linkedin')->nullable();
            $table->string('Tiktok')->nullable();
            $table->string('Instagram')->nullable();
            $table->string('Facebook')->nullable();
            $table->text('Testimoni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alumni');
    }
};
