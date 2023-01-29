<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectsController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->hasRole('admin'))
        {
            return redirect()->route('admin.dashboard.index');
        }
        else if($request->user()->hasRole('member'))
        {
            return redirect()->route('member.dashboard.index');
        }
        else if($request->user()->hasRole('employee')){
            return redirect()->route('employee.dashboard.index');
        }
        else {
            throw new \Exception("Error : The User Making This Request Has No Role Associated To It.");
        }
    }
}
