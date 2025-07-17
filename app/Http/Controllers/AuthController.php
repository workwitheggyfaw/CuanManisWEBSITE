<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Alias tambahan untuk menangani rute yang salah arah
    // (Opsional — bisa dihapus jika rute sudah diperbaiki)
    public function showLogin()
    {
        return $this->showLoginForm();
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

 public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:6|confirmed',
            'no_hp'            => 'required|string|max:20',
            'foto_profil'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kartu_mahasiswa'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Foto profil is optional
        $fotoProfilName = null;
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $fotoProfilName = basename($path);
        }

        // Kartu mahasiswa upload (required)
        $ktmPath = $request->file('kartu_mahasiswa')->store('ktm', 'public');
        $ktmName = basename($ktmPath);

        // Create user record
        $user = User::create([
            'nama'             => $request->nama,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'no_hp'            => $request->no_hp,
            'foto_profil'      => $fotoProfilName,
            'kartu_mahasiswa'  => $ktmName,
        ]);

        Auth::login($user);

        return redirect('/login')
                         ->with('success', 'Registrasi berhasil! Selamat datang di Cuan Manis.');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
