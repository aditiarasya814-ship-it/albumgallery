<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses Login
    public function postLogin(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/foto');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // Menampilkan halaman register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses Register
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
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    // Logout
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}