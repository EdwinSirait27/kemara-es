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
        Schema::table('tb_alumni', function (Blueprint $table) {
            Schema::table('tb_alumni', function (Blueprint $table) {
                $table->string('Gelar')->nullable()->change(); // Ubah kolom 'gelar' menjadi string
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_alumni', function (Blueprint $table) {
            $table->enum('Gelar', ['D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'Prof', 'Tidak Ada'])
                  ->nullable()
                  ->change(); // Kembalikan ke enum jika di-rollback
        });
    }
};
