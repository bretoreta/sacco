<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMemberRequest;
use App\Http\Requests\Admin\UpdateMemberRequest;
use App\Models\LoanUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class MembersController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Members/Index', [
            'all_count' => User::all()->count(),
            'admins_count' => User::role('admin')->count(),
            'members_count' => User::role('member')->count(),
            'employees_count' => User::role('employee')->count(),
            'members' => User::latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Members/Create', [
            'all_count' => User::all()->count(),
            'admins_count' => User::role('admin')->count(),
            'members_count' => User::role('member')->count(),
            'employees_count' => User::role('employee')->count(),
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Admin/Members/Show', [
            'member' => $user->load(['accounts.account_type', 'transactions.actor', 'transactions.account.account_type']),
            'loans' => LoanUser::where('user_id', $user->id)->with(['plan', 'loan'])->get(),
        ]);
    }

    public function manage()
    {
        return Inertia::render('Admin/Members/Manage', [
            'members' => User::role('member')
                                ->latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'id_number' => $data['id_number'],
            'phone_number' => $data['phone_number'],
            'kra_tax_number' => $data['kra_tax_number'],
            'address' => $data['address'],
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('member');

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Member Account Has Been Created Successfully. The default password is "password"'
        ]);
    }

    public function update(UpdateMemberRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update($data);

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Member Account Has Been Updated Successfully'
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Member Account Has Been Deleted Successfully'
        ]);
    }

    public function verify(User $user)
    {
        $user->email_verified_at = now();
        $user->save();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Member Account Has Been Verified Successfully'
        ]);
    }

    public function unverify(User $user)
    {
        $user->email_verified_at = null;
        $user->save();

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Member Account Has Been Un-Verified Successfully'
        ]);
    }
}
