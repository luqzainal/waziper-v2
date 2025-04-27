<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

// Laluan utama redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Laluan yang memerlukan pengesahan (auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Contoh laluan devices jika masih diperlukan
    // Route::resource('devices', \App\Http\Controllers\DeviceWebController::class);
    // Route::get('/chat/{device}', [DashboardController::class, 'chatLog'])->name('chat.log');
    // Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    // Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store')->middleware('device.limit');
    // Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
    // Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
});

require __DIR__.'/auth.php';

// Pastikan semua kod di bawah baris ini telah dibuang atau dikomen
// // Route::get('/dashboard', function () {
// //     return view('dashboard');
// // })->middleware(['auth', 'verified'])->name('dashboard');

// // Route::middleware('auth')->group(function () {
// //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// //     // Device Routes
// //     Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
// //     Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store')->middleware('device.limit');
// //     Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
// //     Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
// // });

// // use App\Http\Controllers\DashboardController;

// // Route::middleware(['auth'])->group(function () {
// //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// //     Route::resource('devices', \App\Http\Controllers\DeviceWebController::class);
// //     Route::get('/chat/{device}', [DashboardController::class, 'chatLog'])->name('chat.log');
// // });
