<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterLoansRequest;
use App\Models\Loan;
use App\Models\LoanUser;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class LoansReportController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Reports/Loans', [
            'loans' => QueryBuilder::for(LoanUser::with(['user:id,name,id_number,phone_number', 'loan:id,loan_type','plan'])->latest())
                        ->paginate()
                        ->appends(request()->query()),
            'loan_types' => Loan::all(['id', 'loan_type']),
        ]);
    }

    public function filter(FilterLoansRequest $request)
    {
        $data = $request->validated();

        return $this->handleFilters($data);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'input' => 'required|string|max:255'
        ]);

        $transactions = LoanUser::WhereHas('user', function($query) use ($data) {
            $query->where('name', 'like', "%{$data['input']}%")
                    ->orWhere('phone_number', 'like', "%{$data['input']}%")
                    ->orWhere('id_number', 'like', "%{$data['input']}%");
        })->orWhereHas('loan', function($query) use ($data){
            $query->where('loan_type', 'like', "%{$data['input']}%");
        })->with(['user', 'loan'])->latest()->paginate();

        return response()->json(data: $transactions, status: 200);
    }

    private function handleFilters($data)
    {
        $loan = LoanUser::query();

        if($data['loan_type'])
        {
            $loan->whereHas('loan', function($query) use ($data) {
                $query->where('loan_type', $data['loan_type']);
            });
        }

        if($data['date']['start'] && $data['date']['end'])
        {
            $loan->whereBetween('created_at', [$data['date']['start'], $data['date']['end']]);
        }

        if($data['day'])
        {
            $loan->where('created_at', $data['day']);
        }

        return $loan->with(['user:id,name,id_number,phone_number', 'loan:id,loan_type','plan'])->latest()->paginate()->appends(request()->query());
    }
}
