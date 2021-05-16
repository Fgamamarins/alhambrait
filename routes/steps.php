<?php

use App\Http\Controllers\Steps\RegisterStepsController;
use Illuminate\Support\Facades\Route;

Route::get('register', [RegisterStepsController::class, 'register'])
     ->middleware('registerCookie')
     ->name('register');

Route::prefix('register')->group(function() {
    Route::post('/step-one', [RegisterStepsController::class, 'stepOne'])->name('stepOne');
    Route::post('/step-two', [RegisterStepsController::class, 'stepTwo'])->name('stepTwo');
    Route::post('/step-three', [RegisterStepsController::class, 'stepThree'])->name('stepThree');
});
