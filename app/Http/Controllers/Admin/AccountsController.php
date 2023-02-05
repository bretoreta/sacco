<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAccountRequest;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\User;
use Inertia\Inertia;

class AccountsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Accounts/Index', [
            'all_count' => Account::all()->count(),
            'general_count' => Account::whereRelation('account_type', 'name', 'General Account')->count(),
            'savings_count' => Account::whereRelation('account_type', 'name', 'Savings Account')->count(),
            'contributions_count' => Account::whereRelation('account_type', 'name', 'Contribution Account')->count(),
            'accounts' => Account::with(['user:id,name,phone_number', 'account_type:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query()),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Accounts/Create', [
            'account_types' => AccountType::all(['id', 'name']),
            'users' => User::all(['id', 'name']),
            'all_count' => Account::all()->count(),
            'general_count' => Account::whereRelation('account_type', 'name', 'General Account')->count(),
            'savings_count' => Account::whereRelation('account_type', 'name', 'Savings Account')->count(),
            'contributions_count' => Account::whereRelation('account_type', 'name', 'Contribution Account')->count(),
        ]);
    }

    public function store(StoreAccountRequest $request)
    {
        $data = $request->validated();

        if(Account::where('user_id', $data['user']['id'])->where('account_type_id', $data['account_type']['id'])->count() > 0)
        {
            return back()->with('message', [
                'type' => 'error',
                'message' => 'Account Already Exists For This User'
            ]);
        }
        else {
            Account::create([
                'user_id' => $data['user']['id'],
                'account_type_id' => $data['account_type']['id'],
                'status' => 'active',
                'available_balance' => 0,
            ]);
        }

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Account Has Been Created Successfully'
        ]);
    }

    public function general()
    {
        return Inertia::render('Admin/Accounts/General', [
            'accounts' => Account::whereRelation('account_type', 'name', 'General Account')
                                ->with(['user:id,name,phone_number', 'account_type:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function savings()
    {
        return Inertia::render('Admin/Accounts/Savings', [
            'accounts' => Account::whereRelation('account_type', 'name', 'Savings Account')
                                ->with(['user:id,name,phone_number', 'account_type:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function contributions()
    {
        return Inertia::render('Admin/Accounts/Contributions', [
            'accounts' => Account::whereRelation('account_type', 'name', 'Contributions Account')
                                ->with(['user:id,name,phone_number', 'account_type:id,name'])
                                ->latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function activate(Account $account)
    {
        $account->status = 'active';
        $account->save();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Account Has Been Activated Successfully'
        ]);
    }

    public function freeze(Account $account)
    {
        $account->status = 'frozen';
        $account->save();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Account Has Been Frozen Successfully'
        ]);
    }
}
