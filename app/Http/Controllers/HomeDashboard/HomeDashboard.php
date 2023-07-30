<?php

namespace App\Http\Controllers\HomeDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeDashboard extends Controller
{
    public function index()
    {
        return view('layouts.home-dashboard.index');
    }
}
