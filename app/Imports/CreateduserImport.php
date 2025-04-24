<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CreateduserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $Username = $row[1];
        $rawDate = $row[0];

        try {
            if (is_numeric($rawDate)) {
                // Format Excel: serial number
                $created = Carbon::instance(Date::excelToDateTimeObject($rawDate));
            } else {
                // Format teks, contoh: 4/23/2025 14:03
                $created = Carbon::createFromFormat('n/j/Y H:i', $rawDate);

                // Kalau format detik juga kadang muncul (misal 4/23/2025 14:03:00)
                if (!$created) {
                    $created = Carbon::createFromFormat('n/j/Y H:i:s', $rawDate);
                }
            }
        } catch (\Exception $e) {
            $created = null;
        }

        $user = User::find($Username);

        if ($user && $Username >= 20250001
        && $Username <= 20250057

        && $created) {
            $user->timestamps = false;
            $user->created_at = $created;
            $user->save();
        }

        return null;
    }
}
