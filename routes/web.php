<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoanTypesController;
use App\Http\Controllers\RedirectsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/uuid', function(){
    dd(Uuid::uuid4());
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
     // Handle Redirects To Appropriate Dashboards
    Route::get('/redirects', [RedirectsController::class, 'index']);

    // Employee Route Groups
    Route::middleware(['role:employee'])->prefix('employee')->group(function() {

    })->name('employee.');

    // Member Route Groups
    Route::middleware(['role:member'])->prefix('member')->group(function() {

    })->name('member.');
});