<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterTransactionsRequest;
use App\Models\Transaction;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
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

    public function generatePdf(Request $request)
    {
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->download();
    }

    public function showPdf(Request $request)
    {
        
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
