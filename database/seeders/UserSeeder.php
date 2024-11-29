<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = storage_path('app/public/seederlaravel.xlsx'); // Sesuaikan path file

        // Import data dari Excel
        Excel::import(new UsersImport, $filePath);
    }
}
// <?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

// class UserSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         DB::table('users')->insert([
//             'id' => 1,
//             'name' => 'admin',
//             'email' => 'admin@softui.com',
//             'password' => Hash::make('secret'),
//             'created_at' => now(),
//             'updated_at' => now()
//         ]);
//     }
// }
