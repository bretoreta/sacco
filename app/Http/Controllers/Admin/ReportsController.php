<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class ReportsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Reports/Index');
    }
}
