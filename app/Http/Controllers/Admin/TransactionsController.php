<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => Transaction::with(['user', 'actor'])
                                            ->latest()
                                            ->paginate()
                                            ->appends(request()->query())
        ]);
    }
}
