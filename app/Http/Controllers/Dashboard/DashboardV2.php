<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardV2 extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.dashboard-v2');
    }
}
