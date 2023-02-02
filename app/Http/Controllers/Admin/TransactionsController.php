<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TransactionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => Transaction::with(['user:id,name,id_number,phone_number', 'actor:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query()),
            'loan_disbursements_sum' => Transaction::where('for', 'loan_disbursement')->sum('amount'),
            'loan_repayments_sum' => Transaction::where('for', 'loan_repayment')->sum('amount'),
            'contributions_sum' => Transaction::where('for', 'contribution')->sum('amount'),
            'deposits_sum' => Transaction::where('for', 'deposit')->sum('amount'),
        ]);
    }
}
