<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoansController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Loans/Index', [
            'loans' => LoanUser::with(['user:id,name,id_number,phone_number', 'loan:id,loan_type','plan'])->paginate(),
        ]);
    }
}
