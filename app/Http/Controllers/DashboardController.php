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
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.index');
        }

        $stats = $user->getDashboardStats();

        return view('pages.dashboard', compact('user', 'stats'));
    }
}
