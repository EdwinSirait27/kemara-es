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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id', true)->nullable();
            $table->string('foto')->nullable();
            $table->string('NOPDF')->unique()->nullable();
            $table->string('NamaLengkap')->nullable();
            $table->string('NomorInduk')->unique()->nullable();
            $table->string('NamaPanggilan')->nullable();
            $table->enum('JenisKelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('NISN')->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->string('Agama')->nullable();
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
            $table->string('NIK')->unique()->nullable();
            $table->string('GolDarah')->nullable();
            $table->string('TinggalDengan')->nullable();
            $table->string('StatusSiswa')->nullable();
            $table->integer('AnakKe')->nullable();
            $table->integer('SaudaraKandung')->nullable();
            $table->integer('SaudaraTiri')->nullable();
            $table->integer('Tinggicm')->nullable();
            $table->integer('Beratkg')->nullable();
            $table->text('RiwayatPenyakit')->nullable();
            $table->string('AsalSMP')->nullable();
            $table->text('AlamatSMP')->nullable();
            $table->string('NPSNSMP')->nullable();
            $table->string('KabKotaSMP')->nullable();
            $table->string('ProvinsiSMP')->nullable();
            $table->string('NoIjasah')->nullable();
            $table->string('NoSKHUN')->nullable();
            $table->date('DiterimaTanggal')->nullable();
            $table->string('DiterimaDiKelas')->nullable();
            $table->string('DiterimaSemester')->nullable();
            $table->string('MutasiAsalSMA')->nullable();
            $table->text('AlasanPindah')->nullable();
            $table->string('NoPesertaUNSMP')->nullable();
            $table->date('TglIjasah')->nullable();
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
            $table->integer('TamatBelajarTahun')->nullable();
            $table->text('TanggalNomorSTTB')->nullable();
            $table->text('InformasiLain')->nullable();
            $table->string('cita')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->nullable();
            // $table->unsignedBigInteger('kelas_id')->nullable();
            $table->integer('sakit')->default(0)->nullable();
            $table->integer('izin')->default(0)->nullable();
            $table->integer('tk')->default(0)->nullable();
            $table->text('catatan')->nullable()->nullable();
            $table->string('no_pdf')->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswa');
    }
};
