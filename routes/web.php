<?php

use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\LandingController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\PatientDashboardController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/check-nik', [PasienController::class, 'checkNik'])->name('check.nik');

// Patient Auth
Route::post('/login', [PatientAuthController::class, 'login'])->name('patient.login');
Route::get('/register', [PatientAuthController::class, 'showRegisterForm'])->name('patient.register');
Route::post('/register', [PatientAuthController::class, 'register'])->name('patient.register.submit');
Route::post('/logout', [PatientAuthController::class, 'logout'])->name('patient.logout');

// Patient Dashboard & Protected Routes
Route::prefix('patient')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
    Route::get('/history', [PatientDashboardController::class, 'history'])->name('patient.history');
    Route::get('/settings', [PatientDashboardController::class, 'settings'])->name('patient.settings');
    Route::post('/settings', [PatientDashboardController::class, 'updateSettings'])->name('patient.settings.update');
});

Route::get('/pendaftaran', [PasienController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PasienController::class, 'store'])->name('pendaftaran.store');
Route::get('/antrian', [PasienController::class, 'showQueue'])->name('queue.show');

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    
    // New Segmented Routes
    Route::get('/pembayaran', [App\Http\Controllers\AdminController::class, 'pembayaran'])->name('admin.pembayaran');
    Route::get('/antrian-poli', [App\Http\Controllers\AdminController::class, 'antrian'])->name('admin.antrian');
    Route::get('/dokter', [App\Http\Controllers\AdminController::class, 'dokter'])->name('admin.dokter');

    Route::patch('/call/{id}', [App\Http\Controllers\AdminController::class, 'callPatient'])->name('admin.call');
    Route::patch('/confirm/{id}', [App\Http\Controllers\AdminController::class, 'confirmPatient'])->name('admin.confirm');
    Route::patch('/skip/{id}', [App\Http\Controllers\AdminController::class, 'skipPatient'])->name('admin.skip');
    
    Route::patch('/verify/{id}', [App\Http\Controllers\AdminController::class, 'verifyPayment'])->name('admin.verify');
    Route::post('/examination/{id}', [App\Http\Controllers\AdminController::class, 'storeExamination'])->name('admin.store_examination');
    
    Route::get('/pasien', [App\Http\Controllers\AdminController::class, 'listPasien'])->name('admin.pasien');
    Route::get('/pasien/{id}', [App\Http\Controllers\AdminController::class, 'showPasien'])->name('admin.pasien.show');
    Route::delete('/pasien/{id}', [App\Http\Controllers\AdminController::class, 'destroyPasien'])->name('admin.pasien.destroy');
});

require __DIR__.'/settings.php';
