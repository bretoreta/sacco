<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Loans\ApproveLoan;
use App\Actions\Admin\Loans\CreateLoan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoansRequest;
use App\Models\Loan;
use App\Models\LoanUser;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function create()
    {
        return Inertia::render('Admin/Loans/Create', [
            'plans' => Plan::all(['id', 'name', 'interest_rate', 'repayment_months']),
            'loan_types' => Loan::all(['id', 'loan_type']),
            'users' => User::all(['id', 'name', 'id_number']),
            'loans' => LoanUser::all(['uuid', 'status']),
        ]);
    }

    public function store(LoansRequest $request)
    {
        $data = $request->validated();

        CreateLoan::hanlde($data);

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Loan application has been added successfully'
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
        $account = $loan->user->accounts()
        ->whereRelation('account_type', 'name', '=', 'General Account')
        ->where('status', 'active')->first();
        if($account)
        {
            ApproveLoan::handle($account, $loan);

            return back()->with('message', [
                'type' => 'success',
                'message' => 'Loan application has been approved successfully'
            ]);
        }

        return back()->with('message', [
            'type' => 'error',
            'message' => 'This user does not have a general account. Please open an account first'
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
