<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Log;
use App\Models\Health;
use App\Models\Death;
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

Route::get('/health', function () {
    return view('health');
})
    ->middleware(['auth', 'verified'])
    ->name('health');

Route::get('/insurance-coverage', function () {
    return view('insurance-coverage');
})
    ->middleware(['auth', 'verified'])
    ->name('insurance-coverage');

Route::get('/health-information/{record}', function ($record) {
    $healthRecord = Health::findOrFail($record);

    return view('view-health-data', ['record' => $healthRecord]);
})
    ->middleware(['auth', 'verified'])
    ->name('view-health');

Route::get('/death-information/{record}', function ($record) {
    $deathRecord = Death::findOrFail($record);

    return view('view-death-data', ['record' => $deathRecord]);
})
    ->middleware(['auth', 'verified'])
    ->name('view-death');

Route::get('/death', function () {
    return view('death');
})
    ->middleware(['auth', 'verified'])
    ->name('death');

Route::get('/death-inquiry', function () {
    return view('death-inquiry');
})
    ->middleware(['auth', 'verified'])
    ->name('death-inquiry');

Route::get('/log', function () {
    return view('log');
})
    ->middleware(['auth', 'verified'])
    ->name('log');

Route::get('/view-log/{record}', function ($record) {
    $logRecord = Log::findOrFail($record);

    return view('view-log', ['record' => $logRecord]);
})
    ->middleware(['auth', 'verified'])
    ->name('view-log');

Route::get('/mortuary', function () {
    return view('mortuary');
})
    ->middleware(['auth', 'verified'])
    ->name('mortuary');

Route::get('/mortuary-inquiry', function () {
        return view('mortuary-inquiry');
})
    ->middleware(['auth', 'verified'])
    ->name('mortuary-inquiry');

Route::get('/cash-advance', function () {
    return view('cash-advance');
})
    ->middleware(['auth', 'verified'])
    ->name('cash-advance');

Route::get('/cash-advance-inquiry', function () {
    return view('cash-advance-inquiry');
})
    ->middleware(['auth', 'verified'])
    ->name('cash-advance-inquiry');

Route::get('/settings', function () {
    return view('settings');
})
    ->middleware(['auth', 'verified'])
    ->name('settings');

Route::get('/inquiry', function () {
    return view('inquiry');
})
    ->middleware(['auth', 'verified'])
    ->name('inquiry');

Route::get('/calendar', function () {
    return view('calendar');
})
    ->middleware(['auth', 'verified'])
    ->name('calendar');

Route::get('/report', function () {
    return view('report');
})
    ->middleware(['auth', 'verified'])
    ->name('report');

Route::get('/death-report', function () {
        return view('death-report');
})
    ->middleware(['auth', 'verified'])
    ->name('death-report');

Route::get('/cash-advance-report', function () {
        return view('cash-advance-report');
})
    ->middleware(['auth', 'verified'])
    ->name('cash-advance-report');

Route::get('/mortuary-report', function () {
        return view('mortuary-report');
})
    ->middleware(['auth', 'verified'])
    ->name('mortuary-report');

Route::get('/upload', function () {
    return view('upload');
})
    ->middleware(['auth', 'verified'])
    ->name('upload');

Route::get('/report', function () {
    return view('report');
})
    ->middleware(['auth', 'verified'])
    ->name('report');
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
