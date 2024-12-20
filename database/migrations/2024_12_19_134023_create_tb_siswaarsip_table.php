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
        Schema::create('tb_siswaarsip', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->nullable()->primary();
            $table->string('NamaLengkap')->unique()->nullable();
            $table->string('NomorInduk')->nullable();
            $table->string('NamaPanggilan')->nullable();
            $table->enum('JenisKelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('NISN')->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->enum('Agama', ['Katolik', 'Kristen Protestan','Hindu','Buddha','Islam','Konghucu'])->nullable();
            $table->text('Alamat')->nullable();
            $table->string('RT')->nullable();
            $table->string('RW')->nullable();
            $table->string('Kelurahan')->nullable();
            $table->string('Kecamatan')->nullable();
            $table->string('KabKota')->nullable();
            $table->string('Provinsi')->nullable();
            $table->string('KodePos')->nullable();
            $table->string('Email')->nullable();
            $table->string('NomorTelephone')->nullable();
            $table->string('Kewarganegaraan')->nullable();
            $table->string('NIK')->nullable();
            $table->string('GolDarah')->nullable();
            $table->string('TinggalDengan')->nullable();
            $table->enum('StatusSiswa', ['Lengkap', 'Yatim','Piatu','Yatim Piatu'])->nullable();
            $table->enum('AnakKe', ['1', '2','3','4','5'])->nullable();
            $table->enum('SaudaraKandung', ['1', '2','3','4','5'])->nullable();
            $table->enum('SaudaraTiri', ['1', '2','3','4','5'])->nullable();
            $table->integer('Tinggicm')->nullable();
            $table->integer('Beratkg')->nullable();
            $table->text('RiwayatPenyakit')->nullable();
            $table->string('AsalSD')->nullable();
            $table->text('AlamatSD')->nullable();
            $table->string('NPSNSD')->nullable();
            $table->string('KabKotaSD')->nullable();
            $table->string('ProvinsiSD')->nullable();
            $table->string('NoIjasah')->nullable();
            $table->date('DiterimaTanggal')->nullable();
            $table->enum('DiterimaDiKelas',['X','XI','XII'])->nullable();
            $table->enum('DiterimaSemester',['Ganjil','Genap'])->nullable();
            $table->string('MutasiAsalSMP')->nullable();
            $table->text('AlasanPindah')->nullable();
            $table->date('TglIjasahSD')->nullable();
            $table->string('NamaOrangTuaPadaIjasah')->nullable();
            $table->string('NamaAyah')->nullable();
            $table->integer('TahunLahirAyah')->nullable();
            $table->text('AlamatAyah')->nullable();
            $table->string('NomorTelephoneAyah')->nullable();
            $table->string('AgamaAyah')->nullable();
            $table->string('PendidikanTerakhirAyah')->nullable();
            $table->string('PekerjaanAyah')->nullable();
            $table->string('PenghasilanAyah')->nullable();
            $table->string('NamaIbu')->nullable();
            $table->integer('TahunLahirIbu')->nullable();
            $table->text('AlamatIbu')->nullable();
            $table->string('NomorTelephoneIbu')->nullable();
            $table->string('AgamaIbu')->nullable();
            $table->string('PendidikanTerakhirIbu')->nullable();
            $table->string('PekerjaanIbu')->nullable();
            $table->string('PenghasilanIbu')->nullable();
            $table->string('NamaWali')->nullable();
            $table->integer('TahunLahirWali')->nullable();
            $table->text('AlamatWali')->nullable();
            $table->string('NomorTelephoneWali')->nullable();
            $table->string('AgamaWali')->nullable();
            $table->string('PendidikanTerakhirWali')->nullable();
            $table->string('PekerjaanWali')->nullable();
            $table->string('WaliPenghasilan')->nullable();
            $table->string('StatusHubunganWali')->nullable();
            $table->text('MenerimaBeasiswaDari')->nullable();
            $table->integer('TahunMeninggalkanSekolah')->nullable();
            $table->text('AlasanSebab')->nullable();
            $table->text('InformasiLain')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif','Lulus','Alumni'])->nullable();
            $table->date('TahunDaftar')->nullable();
            $table->date('TamatBelajarTahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswaarsip');
    }
};
