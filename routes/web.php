<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EnginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParcController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TypeparcController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

// /configs
Route::prefix('configs')->group(function () {
    Route::get('/', [ConfigController::class, 'index'])->name('configs');
    Route::resource('sites', SiteController::class);
    Route::resource('typeparcs', TypeparcController::class);
    Route::resource('parcs', ParcController::class);
    Route::resource('engins', EnginController::class);
});

Route::get('/counter', Counter::class);
