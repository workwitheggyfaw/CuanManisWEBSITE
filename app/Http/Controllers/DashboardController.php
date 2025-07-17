<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kosan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Terapkan middleware 'auth' ke semua route di controller ini.
     * Kalau guest mencoba akses, otomatis dikirim ke /login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman utama dashboard
     */
    public function index()
    {
        // user pasti sudah login, jadi Auth::user() tidak null
        $userId  = Auth::id();

        $barang = Barang::where('id_user', $userId)
                         ->latest()
                         ->get();

        $kosan  = Kosan::where('id_user', $userId)
                         ->latest()
                         ->get();

        return view('dashboard', compact('barang', 'kosan'));
    }

    /**
     * Tampilkan grafik di dashboard
     */
    public function graph()
    {
        $userId     = Auth::id();
        $barangCount = Barang::where('id_user', $userId)->count();
        $kosCount    = Kosan::where('id_user', $userId)->count();

        return view('dashboard.graph', compact('barangCount', 'kosCount'));
    }
}
