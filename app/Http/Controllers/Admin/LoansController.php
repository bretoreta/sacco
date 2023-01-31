<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanUser;
use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class LoansController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Loans/Index', [
            'loans' => QueryBuilder::for(LoanUser::with(['user:id,name,id_number,phone_number', 'loan:id,loan_type','plan'])->latest())
                                ->paginate()
                                ->appends(request()->query()),
        ]);
    }

    public function update(Request $request, LoanUser $loan)
    {
        $data = $request->validate([
            'loan_id' => 'required|max:255|exists:loans,id',
            'plan_id' => 'required|max:255|exists:plans,id',
            'amount_payable' => 'required|integer'
        ]);

        $loan->update($data);

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Loan application has been updated successfully'
        ]);
    }

    public function delete(LoanUser $loan)
    {
        $loan->delete();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Loan application has been deleted successfully'
        ]);
    }

    public function approveLoan(LoanUser $loan)
    {
        $loan->status = 'approved';
        $loan->save();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Loan application has been approved successfully'
        ]);
    }

    public function rejectLoan(LoanUser $loan)
    {
        $loan->status = 'rejected';
        $loan->save();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Loan application has been rejected successfully'
        ]);
    }

    public function approve(Request $request)
    {
        return Inertia::render('Admin/Loans/Approval', [
            'loans' => QueryBuilder::for(LoanUser::where('status', 'pending')
                                ->with(['user:id,name,id_number,phone_number', 'loan:id,loan_type', 'plan'])->latest())
                                ->paginate()
                                ->appends(request()->query()),
            'plans' => Plan::all(['id', 'name']),
            'loan_types' => Loan::all(['id', 'loan_type'])
        ]);
    }
}
