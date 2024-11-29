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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_id')->after('id')->nullable();
            $table->unsignedBigInteger('siswa_id')->after('guru_id')->nullable();
         
               $table->foreign('guru_id')->references('guru_id')->on('tb_guru')->onDelete('cascade');
               $table->foreign('siswa_id')->references('siswa_id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('siswa_id');
            $table->dropColumn('guru_id');
        });
    }
};
