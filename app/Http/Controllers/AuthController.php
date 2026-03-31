<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Penting: Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Cek role untuk mengarahkan ke dashboard yang sesuai (Opsional)
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/foto');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function postRegister(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => 'user', // Memastikan pendaftar baru adalah user biasa
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        // Bersihkan session secara total
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}