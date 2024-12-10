<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    
    {
        //untuk batas registrasi
        $maxUsers = 200;
        $currentUserCount = User::count();
        if ($currentUserCount >= $maxUsers) {
            // Jika jumlah pengguna sudah mencapai batas, lemparkan exception
            abort(403, 'Pengguna sudah melebihi batas kuota');
        }

        // Validasi input termasuk nomor handphone
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phone' => [
                'required',
                'string',
                'max:15',
                'regex:/^\+?[0-9]{10,15}$/', // Format nomor telepon
                Rule::unique(User::class),
            ],

            'password' => $this->passwordRules(),
        ], [
            'phone.required' => 'Nomor handphone diperlukan.',
            'phone.regex' => 'Nomor handphone tidak valid.',
            'phone.unique' => 'Nomor handphone sudah terdaftar.',
            'password.required' => 'Password diperlukan.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf kecil, huruf besar, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ])->validate();

        // Menyimpan pengguna baru
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'], 
            'password' => Hash::make($input['password']),
        ]);
    }
}
