<?php
namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CreateImport implements ToModel
{
    public function model(array $row)
    {
        $siswaId = $row[1];
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

        $siswa = Siswa::find($siswaId);

        if ($siswa && $siswaId >= 15 && $siswaId <= 73 && $created) {
            $siswa->timestamps = false;
            $siswa->created_at = $created;
            $siswa->save();
        }

        return null;
    }
}
