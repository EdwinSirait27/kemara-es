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
        Schema::table('tb_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('tahunakademik_id')->after('guru_id')->nullable();
         
               $table->foreign('tahunakademik_id')->references('id')->on('tb_tahunakademik')->onDelete('set null');
               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
