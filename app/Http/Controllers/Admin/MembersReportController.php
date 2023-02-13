<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterMembersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembersReportController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Reports/Members', [
            'members' => User::role('member')
                                ->latest()
                                ->paginate()
                                ->appends(request()->query())
        ]);
    }

    public function filter(FilterMembersRequest $request)
    {
        $data = $request->validated();

        return $this->handleFilters($data);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'input' => 'required|string|max:255'
        ]);

        $members = User::role('member')->where(function($query) use ($data) {
                                $query->where('name', 'like', "%{$data['input']}%")
                                ->orWhere('id_number', 'like', "%{$data['input']}%")
                                ->orWhere('email', 'like', "%{$data['input']}%")
                                ->orWhere('phone_number', 'like', "%{$data['input']}%")
                                ->orWhere('kra_tax_number', 'like', "%{$data['input']}%")
                                ->orWhere('address', 'like', "%{$data['input']}%");
                        })
                        ->latest()->paginate();

        return response()->json(data: $members, status: 200);
    }

    private function handleFilters($data)
    {
        $user = User::query()->role('member');

        if($data['status'])
        {
            $user->where('status', $data['status']);
        }

        if($data['date']['start'] && $data['date']['end'])
        {
            $user->whereBetween('created_at', [$data['date']['start'], $data['date']['end']]);
        }

        return $user->latest()->paginate()->appends(request()->query());
    }
}
