<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required', 
            'string', 
            'min:8', // Minimum 8 karakter
            'regex:/[a-z]/', // Harus ada huruf kecil
            'regex:/[A-Z]/', // Harus ada huruf besar
            'regex:/[0-9]/', // Harus ada angka
            'regex:/[@$!%*?&#]/',
            'confirmed'
            ];
    }
}
