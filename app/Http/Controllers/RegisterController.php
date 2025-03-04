<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('register');
    }

    

    /**
     * Menangani proses registrasi pengguna
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi data yang dimasukkan
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'devisi' => ['required', 'string', 'in:IT,Admin,Digital'], // Validasi "devisi"
        ]);

        // Membuat pengguna baru setelah validasi
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'devisi' => $validatedData['devisi'], // Menyimpan data "devisi"
        ]);

        // Redirect atau login setelah registrasi berhasil
        return redirect()->route('admindashboard')->with('success', 'Registration successful, please login!');
    }
}
