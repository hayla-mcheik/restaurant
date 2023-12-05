<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admindashboard()
    {
        return view('admin.dashboard');
    }

    public function managerdashboard()
    {
        return view('manager.dashboard');
    }

    public function userdashboard()
    {
        return view('user.dashboard');
    }  
}
