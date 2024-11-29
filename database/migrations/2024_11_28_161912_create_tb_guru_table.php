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
            $table->unsignedBigInteger('guru_id', true)->nullable();
            $table->string('foto')->nullable(); // Foto
            $table->string('Nama')->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->string('Agama')->nullable();
            $table->string('JenisKelamin')->nullable();
            $table->string('StatusPegawai')->nullable();
            $table->string('NipNips')->nullable(); // Bisa null jika tidak ada
            $table->string('Nuptk')->nullable();
            $table->string('Nik')->nullable();
            $table->string('Npwp')->nullable();
            $table->string('NomorSertifikatPendidik')->nullable();
            $table->year('TahunSertifikasi')->nullable(); // Tahun
            $table->string('pangkatgt')->nullable(); // Pangkat Golongan Terakhir
            $table->date('jadwalkenaikanpangkat')->nullable(); // Jadwal Kenaikan Pangkat
            $table->date('jadwalkenaikangaji')->nullable(); // Jadwal Kenaikan Gaji
            // $table->date('TMT')->nullable(); // Tanggal Mulai Tugas
            $table->string('PendidikanAkhir')->nullable();
            $table->year('TahunTamat')->nullable();
            $table->string('Jurusan')->nullable();
            $table->string('TugasMengajar')->nullable();
            // $table->string('TugasTambahan')->nullable();
            // $table->integer('JamPerMinggu')->unsigned()->nullable(); // Jumlah jam mengajar
            $table->year('TahunPensiun')->nullable(); // Tahun pensiun
            // $table->string('Berkala')->nullable(); // Status berkala
            $table->string('Pangkat')->nullable(); // Pangkat jabatan
            $table->string('Jabatan')->nullable();
            $table->string('NomorTelephone')->nullable();
            $table->text('Alamat')->nullable(); // Alamat detail
            $table->string('Email')->unique()->nullable(); // Email harus unik
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
