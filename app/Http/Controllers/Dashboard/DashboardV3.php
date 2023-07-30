<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardV3 extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.dashboard-v3');
    }
}
