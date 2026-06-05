<?php

use App\Http\Controllers\SimulateController;
use App\Jobs\DemoJob;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::post('dispatch-demo-job', function () {
        DemoJob::dispatch();

        return redirect()->back()->with('success', 'Demo job dispatched successfully!');
    })->name('demo-job.dispatch');

    Route::post('simulate', [SimulateController::class, 'dispatch'])->name('simulate.dispatch');
});

Route::prefix('simulate')->group(function () {
    Route::get('slow-request', [SimulateController::class, 'slowRequest']);
    Route::get('slow-response', [SimulateController::class, 'slowRequest']);
    Route::get('exception', [SimulateController::class, 'exception']);
});

require __DIR__.'/settings.php';
