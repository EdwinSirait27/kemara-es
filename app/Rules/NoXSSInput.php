<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
// app/Rules/NoXSSInput.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoXSSInput implements Rule
{
    public function passes($attribute, $value)
    {
        // Cek apakah input mengandung potensi XSS
        return strip_tags($value) === $value 
               && !preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $value)
               && !preg_match('/on\w+=/i', $value);
    }

    public function message()
    {
        return 'Input tidak boleh mengandung tag HTML atau script berbahaya.';
    }
}
