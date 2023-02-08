<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMeetingRequest;
use App\Models\Meeting;
use App\Models\MeetingType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeetingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Meetings/Index', [
            'meetings' => Meeting::with('meeting_type')->paginate()->appends(request()->query()),
            'all_count' => Meeting::all()->count(),
            'pending_count' => Meeting::whereDate('happening_on', '>=', Carbon::now())->count(),
            'past_count' => Meeting::whereDate('happening_on', '<', Carbon::now())->count(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Meetings/Create', [
            'meeting_types' => MeetingType::all(['id', 'name']),
            'all_count' => Meeting::all()->count(),
            'pending_count' => Meeting::whereDate('happening_on', '<=', Carbon::now())->count(),
            'past_count' => Meeting::whereDate('happening_on', '>', Carbon::now())->count(),
        ]);
    }

    public function store(StoreMeetingRequest $request)
    {
        $data = $request->validated();

        Meeting::create([
            'meeting_type_id' => $data['meeting_type']['id'],
            'agenda' => $data['agenda'],
            'venue' => $data['venue'],
            'happening_on' => Carbon::createFromFormat('Y-m-d', $data['happening_on'])->createMidnightDate(),
            'is_invite_only' => $data['is_invite_only'],
        ]);

        return back()->with('message', [
            'type' => 'success',
            'message' => 'Meeting Has Been Created Successfully',
        ]);
    }
}
