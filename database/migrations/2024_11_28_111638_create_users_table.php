<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('hakakses', ['SU','Admin', 'Guru', 'Siswa','Kurikulum','NonSiswa','KepalaSekolah'])->nullable();
            $table->set('Role', ['SU', 'Admin', 'Guru','Kurikulum','KepalaSekolah','Siswa'])->nullable();
            // $table->string('no_pdf')->nullable();
            // $table->dateTime('tahundaftar');
            // $table->dateTime()
            $table->rememberToken();
            $table->timestamps(); // created_at dan updated_at otomatis dibuat
            
            // Tambahkan foreign key jika ada relasi
        //     $table->foreign('guru_id')->references('guru_id')->on('tb_guru')->onDelete('cascade');
        //     $table->foreign('siswa_id')->references('guru_id')->on('tb_siswa')->onDelete('cascade');
        // 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateUsersTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('users', function (Blueprint $table) {
//             $table->id();
//             $table->string('name');
//             $table->string('email')->unique();
//             $table->string('password');
//             $table->bigInteger('phone')->nullable();
//             $table->string('location')->nullable();
//             $table->string('about_me')->nullable();
//             $table->rememberToken();
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('users');
//     }
// }
