<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembersController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Members/Index', [
            'members' => User::role('member')
                                ->latest()
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
