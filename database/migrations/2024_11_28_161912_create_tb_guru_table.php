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
        Schema::create('tb_guru', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_id', true)->nullable()->primary();
            $table->string('foto')->nullable(); // Foto
            $table->string('Nama')->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->enum('Agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])->nullable();
            $table->enum('JenisKelamin', ['Laki-Laki','Perempuan'])->nullable();
            $table->enum('StatusPegawai',['GT','PNS YDP','GTT','Honorer','PT','PTT'])->nullable();
            $table->string('NipNips')->nullable(); // Bisa null jika tidak ada
            $table->string('Nuptk')->nullable();
            $table->string('Nik')->nullable();
            $table->string('Npwp')->nullable();
            $table->string('NomorSertifikatPendidik')->nullable();
            $table->date('TahunSertifikasi')->nullable(); // Tahun
            $table->date('jadwalkenaikangaji')->nullable(); // Jadwal Kenaikan Gaji
            $table->string('PendidikanAkhir')->nullable();
            $table->date('TahunTamat')->nullable();
            $table->string('Jurusan')->nullable();
            $table->string('TugasMengajar')->nullable();
            $table->date('TahunPensiun')->nullable(); // Tahun pensiun
            $table->string('Pangkat')->nullable(); // Pangkat jabatan
            $table->date('jadwalkenaikanpangkat')->nullable(); // Jadwal Kenaikan Pangkat
            $table->string('Jabatan')->nullable();
            $table->string('NomorTelephone')->nullable();
            $table->text('Alamat')->nullable(); // Alamat detail
            $table->string('Email')->nullable(); // Email harus unik
            $table->string('status')->nullable(); // Status aktif/nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_guru');
    }
};
