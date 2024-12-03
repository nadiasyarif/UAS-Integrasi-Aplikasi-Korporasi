<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mahasiswas', [MahasiswaController::class, 'index'])->name("mahasiswa-index");
Route::get('/mahasiswas/create', [MahasiswaController::class, 'create'])->name("mahasiswa-create");
Route::post('/mahasiswas', [MahasiswaController::class, 'store'])->name("mahasiswa-store");
Route::get('/mahasiswas/{id}', [MahasiswaController::class, 'show'])->name("mahasiswa-detail");
Route::get('/mahasiswas/{id}/edit', [MahasiswaController::class, 'edit'])->name("mahasiswa-edit");
Route::put('/mahasiswas/{id}', [MahasiswaController::class, 'update'])->name("mahasiswa-update");
Route::delete('/mahasiswas/{id}', [MahasiswaController::class, 'destroy'])->name("mahasiswa-deleted");
Route::get('/mahasiswas/export/excel', [MahasiswaController::class, 'exportExcel'])->name("mahasiswa-export-excel");
Route::get('/mahasiswas/export/pdf', [MahasiswaController::class, 'exportToPDF'])->name("mahasiswa-export-pdf");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
