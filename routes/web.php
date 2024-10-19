<?php

use App\Http\Controllers\LecturerController;
use App\Http\Controllers\AttendanceController;
use Mews\Captcha\CaptchaController;
use App\Http\Controllers\PemateriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Pemateri;
use App\Http\Middleware\Peserta;
use App\Http\Controllers\TugasController;

use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});


Route::middleware(['auth'])->group(function () {

    Route::resource('tugas', TugasController::class);
    
    Route::get('/tugas/download/{learning}', [TugasController::class, 'download'])->name('tugas.download');
    Route::get('/captcha-refresh', [CaptchaController::class, 'refresh']);

    Route::get('/home', function () {
        return view('pages.app.dashboard_lms');
        
    })->name('home');
    
    // Route::resource('user', UserController::class);
    Route::resource('lecturer', LecturerController::class);

    Route::get('/bayar', function () {
        return view('pages.Pembayaran.index');
 })->name('pages.Pembayaran.index');
    
    // Route::resource('absensi', AttendanceController::class);
   

    Route::get('/profil', function () {
        return view('pages.Profile.UserProfile'); 
        
    })->name('pages.Profile.UserProfile');  

});




Route::middleware(Admin::class)->group(function () {

    Route::resource('user', UserController::class);
   
    Route::resource('absensi', AttendanceController::class);
   
    Route::prefix('admin')->group(function () {

           

    });
   
    
});

Route::middleware(Pemateri::class)->group(function () {
    
    Route::resource('absensi', AttendanceController::class);
});
Route::middleware(Peserta::class)->group(function () {
   
    
});


// Route::get('/login', function () {
//     return view('pages.auth.auth-login');
// })->name('login');
// Route::get('register', function () {
//     return view('pages.auth.auth-register');
// })->name('register');

// Route::get('/forgot', function () {
//     return view('pages.auth.auth-forgot-password');
// })->name('forgot');

