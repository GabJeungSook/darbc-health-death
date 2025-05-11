<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Log;
use App\Models\Health;
use App\Models\Death;
use App\Models\CashAdvance;
use App\Models\Mortuary;
use App\Models\CommunityRelation;
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
//
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
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('health');

Route::get('/insurance-coverage', function () {
    return view('insurance-coverage');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('insurance-coverage');

Route::get('/health-information/{record}', function ($record) {
    $healthRecord = Health::findOrFail($record);

    return view('view-health-data', ['record' => $healthRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('view-health');

Route::get('/daily-claims-health/{record}', function ($record) {
    $healthClaimRecord = Health::findOrFail($record);

    return view('view-daily-claims-health', ['record' => $healthClaimRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('daily-claims-health');

Route::get('/death-information/{record}', function ($record) {
    $deathRecord = Death::findOrFail($record);

    return view('view-death-data', ['record' => $deathRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('view-death');

Route::get('/daily-claims-death/{record}', function ($record) {
    $deathClaimRecord = Death::findOrFail($record);

    return view('view-daily-claims-death', ['record' => $deathClaimRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('daily-claims-death');

Route::get('/cash-advance-information/{record}', function ($record) {
    $cashAdvanceRecord = CashAdvance::findOrFail($record);

    return view('view-cash-advance-data', ['record' => $cashAdvanceRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('view-cash-advance');

Route::get('/mortuary-information/{record}', function ($record) {
    $mortuaryRecord = Mortuary::findOrFail($record);

    return view('view-mortuary-data', ['record' => $mortuaryRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('view-mortuary');

Route::get('/death', function () {
    return view('death');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('death');

Route::get('/death-inquiry', function () {
    return view('death-inquiry');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('death-inquiry');

Route::get('/log', function () {
    return view('log');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('log');

Route::get('/view-log/{record}', function ($record) {
    $logRecord = Log::findOrFail($record);

    return view('view-log', ['record' => $logRecord]);
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('view-log');

Route::get('/log-report', function () {
        return view('log-report');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('log-report');

Route::get('/community-relations', function () {
    return view('community-relations');
})
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('community-relations');

Route::get('/community-relation-inquiry', function () {
    return view('community-relation-inquiry');
})
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('community-relation-inquiry');

Route::get('/community-relation-reports', function () {
    return view('community-relation-report');
})
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('community-relation-report');

Route::get('/community-relation-information/{record}', function ($record) {
    $communityRelationRecord = CommunityRelation::findOrFail($record);

    return view('view-community-relation-data', ['record' => $communityRelationRecord]);
})
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('view-community-relation');

Route::get('/community-relation-settings', function () {
    return view('manage-community-relation');
})
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('manage-community-relation');

Route::get('/mortuary', function () {
    return view('mortuary');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('mortuary');

Route::get('/mortuary-inquiry', function () {
        return view('mortuary-inquiry');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('mortuary-inquiry');

Route::get('/cash-advance', function () {
    return view('cash-advance');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('cash-advance');

Route::get('/cash-advance-inquiry', function () {
    return view('cash-advance-inquiry');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('cash-advance-inquiry');

Route::get('/settings', function () {
    return view('settings');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('settings');

Route::get('/inquiry', function () {
    return view('inquiry');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('inquiry');

Route::get('/calendar', function () {
    return view('calendar');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('calendar');

Route::get('/report', function () {
    return view('report');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('report');

Route::get('/death-report', function () {
        return view('death-report');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('death-report');

Route::get('/cash-advance-report', function () {
        return view('cash-advance-report');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('cash-advance-report');

Route::get('/mortuary-report', function () {
        return view('mortuary-report');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('mortuary-report');

Route::get('/upload', function () {
    return view('upload');
})
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('upload');

Route::get('/report', function () {
    return view('report');
})
    ->middleware(['auth', 'verified', 'role:admin'])
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
