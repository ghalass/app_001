<?php

use App\Http\Controllers\ConfigController;
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
    // /configs/sites
    // Route::prefix('sites')->group(function () {
    //     Route::get('/', [SiteController::class, 'index'])->name('sites');
    //     Route::get('/show/{id}', [SiteController::class, 'show'])->name('site.show');

    //     Route::get('/create', [SiteController::class, 'new'])->name('site.new');
    //     Route::post('/create', [SiteController::class, 'create'])->name('site.create');

    //     Route::get('/update/{id}', [SiteController::class, 'update'])->name('site.update');
    //     Route::post('/update/{id}', [SiteController::class, 'store'])->name('site.store');

    //     Route::get('/delete/{id}', [SiteController::class, 'delete'])->name('site.delete');
    //     Route::delete('/destroy/{id}', [SiteController::class, 'destroy'])->name('site.destroy');
    // });

    Route::resource('sites', SiteController::class);
    Route::resource('typeparcs', TypeparcController::class);
    Route::resource('parcs', ParcController::class);
});

Route::get('/counter', Counter::class);
