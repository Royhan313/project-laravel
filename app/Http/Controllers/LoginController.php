<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Fungsi untuk login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek otentikasi
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user(); // Dapatkan user yang baru saja login

            // Cek role user
            if ($user->role == 'admin') {
                // Jika admin, arahkan ke halaman admin
                return redirect()->route('admindashboard');
            } else {
                // Jika user biasa, arahkan ke dashboard biasa
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
