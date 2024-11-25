<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EnginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LubrifiantController;
use App\Http\Controllers\OrganeController;
use App\Http\Controllers\ParcController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TypelubrifiantController;
use App\Http\Controllers\TypeorganeController;
use App\Http\Controllers\TypeparcController;
use App\Http\Controllers\UserController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);
Auth::routes();



Route::get('/counter', Counter::class);

// /configs
Route::prefix('configs')->group(function () {
    Route::get('/', [ConfigController::class, 'index'])->name('configs');

    Route::resource('sites', SiteController::class);
    Route::resource('typeparcs', TypeparcController::class);
    Route::resource('parcs', ParcController::class);
    Route::resource('engins', EnginController::class);
    Route::resource('typelubrifiants', TypelubrifiantController::class);
    Route::resource('lubrifiants', LubrifiantController::class);
    Route::resource('typeorganes', TypeorganeController::class);
    Route::resource('organes', OrganeController::class);
});

//
// Route::group(['middleware' => ['role:super-admin|admin']], function () {
Route::group(['middleware' => ['isAdmin']], function () {
    // Permissions
    Route::resource('permissions', PermissionController::class);
    Route::get('/permissions/{permissionId}/delete', [PermissionController::class, 'destroy'])->name('permissions.delete');

    // Roles
    Route::resource('roles', RoleController::class);
    Route::get('/roles/{roleId}/delete', [RoleController::class, 'destroy'])
        ->name('roles.delete');
    // ->middleware('permission:delete role');

    Route::get('/roles/{roleId}/add-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.add-permissions');
    Route::put('/roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.give-permissions');

    // Users
    Route::resource('users', UserController::class);
    Route::get('/users/{userId}/delete', [UserController::class, 'destroy'])
        ->name('users.delete');
});