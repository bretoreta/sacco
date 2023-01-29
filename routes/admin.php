<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoansController;
use App\Http\Controllers\Admin\LoanTypesController;
use Illuminate\Support\Facades\Route;

// Administrator Route Groups
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])->prefix('admin')->group(function () {
    // Administrator Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Manage Loan
    Route::prefix('loan')->group(function () {
        // Manage Loan Types
        Route::get('/types', [LoanTypesController::class, 'index'])->name('admin.loan.types.index');
        Route::post('/types', [LoanTypesController::class, 'store'])->name('admin.loan.types.store');
        Route::put('/types/{loan}', [LoanTypesController::class, 'update'])->name('admin.loan.types.update');
        Route::delete('/types/{loan}', [LoanTypesController::class, 'delete'])->name('admin.loan.types.delete');
    });

    Route::prefix('/loans')->group(function() {
        // Manage Applied User Loans
        Route::get('/', [LoansController::class, 'index'])->name('admin.loans.index');
    });
});
