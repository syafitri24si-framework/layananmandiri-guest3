<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN PAGE =================
    public function index()
    {
        return view('login');
    }

    // ================= LOGIN PROCESS =================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi!',
            'email.email'       => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min'      => 'Password minimal 6 karakter!',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan!'])->withInput();
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah!'])->withInput();
        }

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    // ================= REGISTER PAGE =================
    public function showRegister()
    {
        return view('register');
    }

    // ================= REGISTER PROCESS =================
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'     => 'Nama wajib diisi!',
            'email.required'    => 'Email wajib diisi!',
            'email.email'       => 'Format email tidak valid!',
            'email.unique'      => 'Email sudah digunakan!',
            'password.required' => 'Password wajib diisi!',
            'password.min'      => 'Password minimal 6 karakter!',
            'password.confirmed'=> 'Konfirmasi password tidak cocok!',
        ]);

        // SIMPAN KE DATABASE
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // LOGIN LANGSUNG SETELAH REGISTER
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
