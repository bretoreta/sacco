<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoansController;
use App\Http\Controllers\Admin\LoanTypesController;
use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\TransactionsController;
use Illuminate\Support\Facades\Route;

// Administrator Route Groups
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])->prefix('admin')->group(function () {
    // Administrator Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::prefix('/loans')->group(function() {
        // Manage Applied User Loans
        Route::get('/', [LoansController::class, 'index'])->name('admin.loans.index');
        Route::post('/', [LoansController::class, 'store'])->name('admin.loans.store');
        Route::get('/create', [LoansController::class, 'create'])->name('admin.loans.create');
        Route::put('/{loan:uuid}', [LoansController::class, 'update'])->name('admin.loans.update');
        Route::delete('/{loan}/delete', [LoansController::class, 'delete'])->name('admin.loans.delete');
        Route::get('/approve', [LoansController::class, 'approve'])->name('admin.loans.approve');
        Route::post('/{loan:uuid}/approve', [LoansController::class, 'approveLoan'])->name('admin.loans.approve.true');
        Route::post('/{loan:uuid}/reject', [LoansController::class, 'rejectLoan'])->name('admin.loans.approve.false');

        // Manage Loan Types
        Route::get('/types', [LoanTypesController::class, 'index'])->name('admin.loans.types.index');
        Route::post('/types', [LoanTypesController::class, 'store'])->name('admin.loans.types.store');
        Route::put('/types/{loan}', [LoanTypesController::class, 'update'])->name('admin.loans.types.update');
        Route::delete('/types/{loan}', [LoanTypesController::class, 'delete'])->name('admin.loans.types.delete');
    });

    Route::prefix('/transactions')->group(function() {
        // Manage Transactions
        Route::get('/', [TransactionsController::class, 'index'])->name('admin.transactions.index');
        Route::get('/disbursements', [TransactionsController::class, 'disbursements'])->name('admin.transactions.disbursements.index');
        Route::get('/repayments', [TransactionsController::class, 'repayments'])->name('admin.transactions.repayments.index');
        Route::get('/contributions', [TransactionsController::class, 'contributions'])->name('admin.transactions.contributions.index');
        Route::get('/deposits', [TransactionsController::class, 'deposits'])->name('admin.transactions.deposits.index');
    });

    Route::prefix('/members')->group(function() {
        // Manage Members
        Route::get('/', [MembersController::class, 'index'])->name('admin.members.index');
        Route::post('/', [MembersController::class, 'store'])->name('admin.members.store');
        Route::get('/manage', [MembersController::class, 'manage'])->name('admin.members.manage');
        Route::get('/create', [MembersController::class, 'create'])->name('admin.members.create');
        Route::put('/{user}/update', [MembersController::class, 'update'])->name('admin.members.update');

        Route::post('/{user}/verify', [MembersController::class, 'verify'])->name('admin.members.verify');
        Route::post('/{user}/unverify', [MembersController::class, 'unverify'])->name('admin.members.unverify');
    });

    Route::prefix('/accounts')->group(function() {
        // Manage Accounts
        Route::get('/', [AccountsController::class, 'index'])->name('admin.accounts.index');
    });

    Route::prefix('/meetings')->group(function() {
        // Manage meetings
        Route::get('/', [MeetingsController::class, 'index'])->name('admin.meetings.index');
    });

    Route::prefix('/legals')->group(function() {
        // Manage legal docs
        Route::get('/', [LegalDocsController::class, 'index'])->name('admin.legals.index');
    });

    Route::prefix('/mailroom')->group(function() {
        // Manage legal docs
        Route::get('/', [MailRoomController::class, 'index'])->name('admin.mailroom.index');
    });

    Route::prefix('/settings')->group(function() {
        // Manage App Settings
        Route::get('/', [SettingsController::class, 'index'])->name('admin.settings.index');
    });

    Route::prefix('/feedback')->group(function() {
        // Manage App feedback
        Route::get('/', [FeedbackController::class, 'index'])->name('admin.feedback.index');
    });
});
