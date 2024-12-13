<?php

use App\Exports\PembayaranExport;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\AttendanceController;
use Mews\Captcha\CaptchaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Pemateri;
use App\Http\Middleware\Peserta;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KumpulTugasController;
use App\Http\Controllers\NilaiController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\LihatNilaiController;
use App\Http\Controllers\HistoryController;

use App\Http\Middleware\EncryptRoute;





Route::get('/login', function () {
    return view('pages.auth.auth-login');
})->name('login');


Route::get('/', function () {
    return view('pages.app.LandingPage.landing');
});

Route::middleware(['auth' ])->group(function () {
 
    
    Route::get('/tugas/download/{learning}', [TugasController::class, 'download'])->name('tugas.download');
   
    Route::get('/captcha-refresh', [CaptchaController::class, 'refresh']);
    Route::get('/home', function () {
    $role = auth::user()->rul;
        if ($role === 'ADMIN') {
            return redirect()->route('dashboard_admin');
        } elseif ($role === 'PEMATERI') {
            return redirect()->route('dashboard_admin'); // Pemateri juga diarahkan ke dashboard admin
        } else {
            return redirect()->route('dashboard_lms');
        }
    })->name('home');

    Route::get('/dashboard_admin', function () {
        return view('pages.app.dashboard_admin');
    })->name('dashboard_admin');
    
    Route::get('/dashboard_lms', function () {
        return view('pages.app.dashboard_lms');
    })->name('dashboard_lms');
    
    
    // Route::resource('user', UserController::class);
    Route::resource('lecturer', LecturerController::class);
    Route::get('/bayar', function () {
        return view('pages.Pembayaran.paket');
    })->name('pages.Pembayaran.paket');
 
    // Route::post('/form', function () {
    // return view('pages.Pembayaran.formbayar');
    // })->name('pages.Pembayaran.formbayar');

    Route::get('/profil', function () {
        return view('pages.Profile.UserProfile'); 
        
    })->name('pages.Profile.UserProfile');  

});

Route::middleware(Admin::class)->group(function () {

    Route::resource('user', UserController::class);
    Route::resource('tugas', TugasController::class);
    Route::resource('absensi', AttendanceController::class);
    Route::get('/nilai/{id}/create', [NilaiController::class, 'create'])->name('nilai.create');
   
    Route::prefix('admin')->group(function () {
    });
    
    
    Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
    Route::get('/pembayaran/{pembayaran}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/nilai/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');

    Route::get('/nilai/{id}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');
    Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
   

Route::middleware(Pemateri::class)->group(function () {
    Route::resource('absensi', AttendanceController::class);
    
    Route::get('/nilai/{id}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');
    
});
});

Route::middleware(Peserta::class)->group(function () {
   
   
    Route::get('/formbayar/download/{id}', [PembayaranController::class, 'download'])->name('formbayar.download');
    Route::get('/materi', [LecturerController::class, 'index'])->name('materi.index'); 
    Route::resource('kumpul', KumpulTugasController::class);
    
});

Route::post('/bayar', [PembayaranController::class, 'StorePembayaranRequest'])->name('pembayaran.store');


Route::group(['middleware' => ['auth', 'Peserta']], function() {
      
 });
 
 Route::get('/form.bayar', [PembayaranController::class, 'showForm'])->name('form.bayar');
 Route::get('/Pembayaran/export', function () {
    return Excel::download(new PembayaranExport, 'Pembayaran.xlsx');
})->name('Pembayaran.export');

//Route::middleware(['auth', 'Admin'])->group(function () {
    // Route::resource('kumpul', KumpulTugasController::class)->only([ 'index','store', 'create', 'destroy']);
//});



//Route::('kumpul/create', [KumpulTugasController::class, 'create'])->name('kumpul.create');

Route::get('kumpul/download/{id}', [KumpulTugasController::class, 'download'])->name('kumpul.download');

Route::middleware('auth', Peserta::class)->group(function () {
    Route::resource('tugas', TugasController::class)->only('index');
});



Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');});
    

   

   
// Rute untuk menyimpan nilai
    Route::post('/nilai/store', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('/lihatnilai', [LihatNilaiController::class, 'index'])->name('lihatnilai.index');
// Rute untuk menghapus nilai
   
    
    Route::get('password/change', function () {
        return view('pages.auth.auth-ganti-password');
    })->name('password.change');

    Route::get('/nilai/{id}/download', [NilaiController::class, 'download'])->name('nilai.download');

    Route::get('/pembayaran/history', [HistoryController::class, 'history'])->name('history.pembayaran');
   
    // Route::post('tugas', [TugasController::class, 'store'])->name('tugas.store');
 
    
  


// Route::get('/dashboaradmin', function () {
//     return view('pages.app.dashboard_admin');
// })->name('pages.app.dashboard_admin');


// Route::get('/test', function () {
//     return view('pages.pembayaran.test');
//  })->name('/test');
// Route::get('register', function () {
//     return view('pages.auth.auth-register');
// })->name('register');

// Route::get('/forgot', function () {
//     return view('pages.auth.auth-forgot-password');
// })->name('forgot');

