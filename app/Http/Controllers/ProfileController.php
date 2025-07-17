<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Tampilkan profil pengguna
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Update profil pengguna
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
                'no_hp' => 'required|string|max:20',
                'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'kartu_mahasiswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
     ]);
         // Handle foto profil upload
        if ($request->hasFile('foto_profil')) {
            // Delete old file if exists
            if ($user->foto_profil) {
                Storage::disk('public')->delete('foto_profil/' . $user->foto_profil);
            }
            // Store new file in public/storage/foto_profil
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $user->foto_profil = basename($path);
        }

        // Handle kartu mahasiswa upload
        if ($request->hasFile('kartu_mahasiswa')) {
            // Delete old file if exists
            if ($user->kartu_mahasiswa) {
                Storage::disk('public')->delete('ktm/' . $user->kartu_mahasiswa);
            }
            // Store new file in public/storage/ktm
            $path = $request->file('kartu_mahasiswa')->store('ktm', 'public');
            $user->kartu_mahasiswa = basename($path);
        }

        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    // Hapus akun pengguna
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Hapus file gambar terkait jika ada
        if ($user->foto_profil) {
            Storage::disk('public')->delete('uploads/profile/' . $user->foto_profil);
        }

        if ($user->kartu_mahasiswa) {
            Storage::disk('public')->delete('uploads/ktm/' . $user->kartu_mahasiswa);
        }

        Auth::logout(); // logout dulu sebelum hapus

        $user->delete(); // hapus user dari DB

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
