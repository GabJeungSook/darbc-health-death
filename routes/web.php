<?php

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/masterlist', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('masterlist');
Route::get('/inquiry', function () {
    return view('inquiry');
})
    ->middleware(['auth', 'verified'])
    ->name('inquiry');

Route::get('/calendar', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('calendar');

Route::get('/report', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('report');

Route::get('/upload', function () {
    return view('upload');
})
    ->middleware(['auth', 'verified'])
    ->name('upload');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

require __DIR__ . '/auth.php';
