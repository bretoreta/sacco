<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentsController;
use App\Http\Controllers\Admin\LoansController;
use App\Http\Controllers\Admin\LoanTypesController;
use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\TransactionsReportController;
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
        Route::post('/', [AccountsController::class, 'store'])->name('admin.accounts.store');
        Route::get('/create', [AccountsController::class, 'create'])->name('admin.accounts.create');
        Route::put('/{account:uuid}/activate', [AccountsController::class, 'activate'])->name('admin.accounts.activate');
        Route::put('/{account:uuid}/freeze', [AccountsController::class, 'freeze'])->name('admin.accounts.freeze');

        // Manage Account Types
        Route::get('/types/general/manage', [AccountsController::class, 'general'])->name('admin.accounts.manage.general');
        Route::get('/types/savings/manage', [AccountsController::class, 'savings'])->name('admin.accounts.manage.savings');
        Route::get('/types/contributions/manage', [AccountsController::class, 'contributions'])->name('admin.accounts.manage.contributions');
        Route::get('/types/settings', [AccountsController::class, 'settings'])->name('admin.accounts.manage.settings');
    });

    Route::prefix('/meetings')->group(function() {
        // Manage meetings
        Route::get('/', [MeetingsController::class, 'index'])->name('admin.meetings.index');
        Route::post('/', [MeetingsController::class, 'store'])->name('admin.meetings.store');
        Route::get('/create', [MeetingsController::class, 'create'])->name('admin.meetings.create');
        Route::get('/manage', [MeetingsController::class, 'manage'])->name('admin.meetings.manage');
        Route::put('/{meeting}/update', [MeetingsController::class, 'update'])->name('admin.meetings.update');
        Route::delete('/{meeting}/delete', [MeetingsController::class, 'delete'])->name('admin.meetings.delete');
    });

    Route::prefix('/docs')->group(function() {
        // Manage legal docs
        Route::get('/', [DocumentsController::class, 'index'])->name('admin.docs.index');
        Route::post('/', [DocumentsController::class, 'store'])->name('admin.docs.store');
        Route::delete('/{document}/delete', [DocumentsController::class, 'delete'])->name('admin.documents.delete');
    });

    Route::prefix('/mailroom')->group(function() {
        // Manage legal docs
        Route::get('/', [MailRoomController::class, 'index'])->name('admin.mailroom.index');
    });

    // Route::prefix('/settings')->group(function() {
    //     // Manage App Settings
    //     Route::get('/', [SettingsController::class, 'index'])->name('admin.settings.index');
    // });

    Route::prefix('/reports')->group(function() {
        // Manage App reports
        Route::get('/', [ReportsController::class, 'index'])->name('admin.reports.index');
        Route::get('/transactions', [TransactionsReportController::class, 'index'])->name('admin.reports.transactions.index');
        Route::post('/transactions/filter', [TransactionsReportController::class, 'filter'])->name('admin.reports.transactions.filter');
        Route::post('/transactions/search', [TransactionsReportController::class, 'search'])->name('admin.reports.transactions.search');
    });

    Route::prefix('/feedback')->group(function() {
        // Manage App feedback
        Route::get('/', [FeedbackController::class, 'index'])->name('admin.feedback.index');
    });
});

Route::get('/dashboard', [DocumentsController::class, 'index'])->name('dashboard');