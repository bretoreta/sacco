<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterAccountsRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountsReportController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Reports/Accounts', [
            'accounts' => Account::with(['user:id,name,phone_number', 'account_type:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function filter(FilterAccountsRequest $request)
    {
        $data = $request->validated();

        return $this->handleFilters($data);
    }

    private function handleFilters($data)
    {
        $user = Account::query();

        if($data['account_type'])
        {
            $user->whereHas('account_type', function($query) use($data) {
                $query->where('name', $data['account_type'])
                    ->orWhere('description', 'like', "%{$data['account_type']}%");
            });
        }

        if($data['status']['active'])
        {
            $user->where('status', 'active');
        }

        if($data['status']['frozen'])
        {
            $user->where('status', 'frozen');
        }
        if($data['range'])
        {
            $user->whereBetween('available_balance', [($data['range'][0]*10000), ($data['range'][1] *10000)]);
        }

        return $user->with(['user:id,name,phone_number', 'account_type:id,name'])->latest()->paginate()->appends(request()->query());
    }
}
