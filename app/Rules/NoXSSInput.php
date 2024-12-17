<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoXSSInput implements Rule
{
    protected $failedReason = '';

    public function passes($attribute, $value)
    {
        // Cek jika value null atau kosong
        if ($value === null || $value === '') {
            return true;
        }

        // Konversi ke string
        $stringValue = (string)$value;

        // Daftar pola XSS yang sangat ketat
        $xssPatterns = [
            '/<\s*script/i',               // Deteksi awal tag script
            '/script\s*>/i',               // Deteksi akhir tag script
            '/<script.*>.*<\/script>/is',  // Tag script lengkap
            '/javascript:/i',              // Protokol javascript
            '/onerror\s*=/i',              // Event error
            '/onclick\s*=/i',              // Event click
            '/onload\s*=/i',               // Event load
            '/&lt;script/i',               // Script dalam encoded HTML
            '/alert\s*\(/i',               // Fungsi alert
            '/eval\s*\(/i',                // Fungsi eval berbahaya
            '/document\.cookie/i',         // Akses cookie
        ];

        // Periksa setiap pola XSS
        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $stringValue)) {
                $this->failedReason = "Pola XSS terdeteksi: " . $pattern;
                return false;
            }
        }

        // Dekode entitas HTML untuk menangkap XSS tersembunyi
        $decodedValue = html_entity_decode($stringValue, ENT_QUOTES, 'UTF-8');
        
        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $decodedValue)) {
                $this->failedReason = "Pola XSS terdeteksi dalam decoded value: " . $pattern;
                return false;
            }
        }

        // Hapus tag HTML secara total
        $strippedValue = strip_tags($stringValue);
        
        // Jika stripped value berbeda, berarti ada tag HTML
        if ($strippedValue !== $stringValue) {
            $this->failedReason = "Terdeteksi tag HTML berbahaya";
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->failedReason ?: 'Input mengandung potensi serangan XSS.';
    }
}

// <?php

// namespace App\Rules;

// use Closure;
// use Illuminate\Contracts\Validation\ValidationRule;
// // app/Rules/NoXSSInput.php
// namespace App\Rules;

// use Illuminate\Contracts\Validation\Rule;

// class NoXSSInput implements Rule
// {
//     public function passes($attribute, $value)
//     {
//         // Cek apakah input mengandung potensi XSS
//         return strip_tags($value) === $value 
//                && !preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $value)
//                && !preg_match('/on\w+=/i', $value);
//     }

//     public function message()
//     {
//         return 'Input tidak boleh mengandung tag HTML atau script berbahaya.';
//     }
// }
