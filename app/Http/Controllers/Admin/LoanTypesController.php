<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\LoanType\CreateLoanType;
use App\Actions\Admin\LoanType\UpdateLoanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoanTypeRequest;
use App\Models\Loan;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class LoanTypesController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/LoanTypes/Index', [
            'loan_types' => QueryBuilder::for(Loan::latest())->paginate()->appends(request()->query())
        ]);
    }

    public function store(LoanTypeRequest $request)
    {
        CreateLoanType::insert($request->validated());

        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'Loan type has been added successfully',
        ]);
    }

    public function update(LoanTypeRequest $request, Loan $loan)
    {
        UpdateLoanType::update($loan, $request->validated());

        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'Loan type has been updated successfully',
        ]);
    }

    public function delete(Loan $loan)
    {
        $loan->delete();

        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'Loan type has been deleted successfully',
        ]);
    }
}
