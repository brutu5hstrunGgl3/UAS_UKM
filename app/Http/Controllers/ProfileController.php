<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function edit()
    {
        // Mendapatkan user yang sedang login
        return view('pages.Profile.UserProfile');
    }

    // Mengupdate data user yang sedang login
    public function update(Request $request, User $user)
    {
        // Mendapatkan user yang sedang login
        
         //auth 
        // Validasi input
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id, // Pastikan email unik kecuali user saat ini
            'phone' => 'nullable|string|max:15', // Menyesuaikan panjang maksimal nomor telepon
            'password' => 'nullable|min:8|confirmed', // Password opsional
        ]);

        // Jika password diisi, hash dan update password
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        // Update data user
       
        $user->fill($data);
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('pages.Profile.UserProfile')->with('success', 'Profile updated successfully.');
    }
}
