<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPetugasDiklat extends Controller
{
    public function index()
    {
        return view('layouts.home-dashboard.index');
    }
}
