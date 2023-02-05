<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Accounts/Index', [
            'all_count' => Account::all()->count(),
            'general_count' => Account::whereRelation('account_type', 'name', 'General Account')->count(),
            'savings_count' => Account::whereRelation('account_type', 'name', 'Savings Account')->count(),
            'contributions_count' => Account::whereRelation('account_type', 'name', 'Contributions Account')->count(),
            'accounts' => Account::with(['user:id,name,phone_number', 'account_type:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query()),
        ]);
    }
}
