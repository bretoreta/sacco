<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterTransactionsRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;
use Spatie\Browsershot\Browsershot;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionsReportController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Reports/Transactions',[
            'transactions' => QueryBuilder::for(Transaction::with(['user:id,name,id_number,phone_number', 'actor:id,name']))
                    ->latest()
                    ->paginate()
                    ->appends(request()->query())
        ]);
    }

    public function filter(FilterTransactionsRequest $request)
    {
        $data = $request->validated();

        return $this->handleFilters($data);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'input' => 'required|string|max:255'
        ]);

        $transactions = Transaction::where('uuid', 'like', "%{$data['input']}%")->orWhereHas('user', function($query) use ($data) {
            $query->where('name', 'like', "%{$data['input']}%")
                    ->orWhere('phone_number', 'like', "%{$data['input']}%")
                    ->orWhere('id_number', 'like', "%{$data['input']}%");
        })->with(['user', 'actor'])->paginate();

        return response()->json(data: $transactions, status: 200);
    }

    private function handleFilters($data)
    {
        $transaction = Transaction::query();

        if($data['for']['loan_disbursement'])
        {
            $transaction->orWhere('for', 'loan_disbursement');
        }

        if($data['for']['loan_repayment'])
        {
            $transaction->orWhere('for', 'loan_repayment');
        }

        if($data['for']['contribution'])
        {
            $transaction->orWhere('for', 'contribution');
        }

        if($data['for']['deposit'])
        {
            $transaction->orWhere('for', 'deposit');
        }

        if($data['date']['start'] && $data['date']['end'])
        {
            $transaction->whereBetween('created_at', [$data['date']['start'], $data['date']['end']]);
        }

        if($data['day'])
        {
            $transaction->where('created_at', $data['day']);
        }

        return $transaction->with(['user:id,name,id_number,phone_number', 'actor:id,name'])->paginate()->appends(request()->query());
    }
}
