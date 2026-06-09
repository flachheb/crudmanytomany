<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StagiaireController;
use App\Http\Middleware\Connected;
use App\Http\Middleware\WallUser;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Autnenticated;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('stagiaires', StagiaireController::class)
->middleware('auth')
;

Route::get('/stagiaires/{stagiaire}/attach-modules', [StagiaireController::class, 'attachModules'])
    ->middleware('auth')
    ->name('stagiaires.attachModules');

Route::post('/stagiaires/{stagiaire}/store-modules', [StagiaireController::class, 'storeModules'])
    ->middleware('auth')
    ->name('stagiaires.storeModules');

Route::resource('modules', ModuleController::class)
->middleware(Autnenticated::class)
;

Route::get('/modules/{module}/attach-stagiaires', [ModuleController::class, 'attachStagiaires'])
    ->middleware('auth')
    ->name('modules.attachStagiaires');

Route::post('/modules/{module}/store-stagiaires', [ModuleController::class, 'storeStagiaires'])
    ->middleware('auth')
    ->name('modules.storeStagiaires');

Route::get('/login', [AuthController::class, 'formlogin'])->name('login');
Route::post('/dologin', [AuthController::class, 'login'])->name('dologin');
Route::delete('/dologout', [AuthController::class, 'logout'])->name('auth.dologout');
