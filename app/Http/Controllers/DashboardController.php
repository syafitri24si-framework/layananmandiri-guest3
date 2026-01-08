<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display dashboard based on user role.
     */
    public function index()
    {
        // Redirect ke home agar tidak error
        return redirect()->route('home');
    }
}
