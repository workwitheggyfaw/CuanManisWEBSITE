<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KosanController extends Controller
{
    // API-style: Ambil semua kosan sebagai JSON
    public function index()
    {
        $kosan = Kosan::with('user')->latest()->get();
        return view('kos.kos_market', compact('kosan'));
    }

    public function dashboard()
{
    $kosan = Kosan::where('id_user', Auth::id())->latest()->get();
    return view('dashboard', compact('kosan'));
}

    // Daftar kosan milik user login
    public function list()
    {
        $kosan = Kosan::where('id_user', Auth::id())->latest()->get();
        return view('kos.kos_market', compact('kosan'));
    }

    // Form tambah kosan
    public function create()
    {
        return view('kos.kos_form', ['kosan' => null]);
    }

    // Simpan data kosan
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama_kos'          => 'required|string|max:100',
        'kategori_kos'      => 'required|in:putra,putri,campur',
        'lokasi'            => 'required|string|max:100',
        'alamat'            => 'required|string',
        'harga'             => 'required|integer',
        'nama_pemilik_kos'  => 'required|string|max:100',
        'no_telepon'        => 'required|string|max:20',
        'foto.*'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $validated;
    $data['id_user'] = Auth::id();

    // Inisialisasi semua kolom foto ke null
    for ($i = 1; $i <= 6; $i++) {
        $data["foto$i"] = null;
    }

    // Proses upload foto[]
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $index => $file) {
            if ($index < 6) {
                $originalName = $file->getClientOriginalName();
                $file->storeAs('uploads/kosan', $originalName, 'public');
                $data['foto'.($index+1)] = $originalName;
            }
        }
    }

    Kosan::create($data);

    return redirect()
        ->route('kos.market')
        ->with('success', 'Data kosan berhasil ditambahkan!');
    }

    

    // Tampilkan detail kosan
    public function show($id_kos)
    {
        $kosan = Kosan::findOrFail($id_kos);
        return view('kos.kos_detail', compact('kosan'));
    }

    // Form edit kosan
    // public function edit($id_kos)
    // {
    //     $kosan = Kosan::findOrFail($id_kos);
    //     if ($kosan->id_user !== Auth::id()) {
    //         abort(403, 'Unauthorized action.');
    //     }
    //     return view('kos.kos_form', compact('kosan'));
    // }

    // Update data kosan
    public function update(Request $request, $id_kos)
    {
        $kosan = Kosan::findOrFail($id_kos);
        if ($kosan->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'nama_kos' => 'required|string|max:100',
            'kategori_kos' => 'required|in:putra,putri,campur',
            'lokasi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'harga' => 'required|integer',
            'nama_pemilik_kos' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($index < 6) {
                    $fotoKey = 'foto' . ($index + 1);
                    if ($kosan->$fotoKey) {
                        Storage::disk('public')->delete($kosan->$fotoKey);
                    }
                    $data[$fotoKey] = $file->store('uploads/kosan', 'public');
                }
            }
        }

        $kosan->update($data);
        return redirect()->back()->with('success', 'Data kosan berhasil diperbarui!');
    }

    // Hapus data kosan
    public function destroy($id_kos)
    {
        $kosan = Kosan::findOrFail($id_kos);
        if ($kosan->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        for ($i = 1; $i <= 6; $i++) {
            $foto = 'foto' . $i;
            if ($kosan->$foto) {
                Storage::disk('public')->delete($kosan->$foto);
            }
        }

        $kosan->delete();
        return redirect()->route('kos.market')->with('success', 'Data kosan berhasil dihapus!');
    }

    // Halaman beranda publik (menampilkan semua kos)
    // public function market()
    // {
    //     $kosan = Kosan::with('user')->latest()->get();
    //     return view('kos.kos_market', compact('kosan'));
    // }
    public function market(Request $request)
    {
        $query = Kosan::with('user')->latest();

        // Searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kos', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%');
            });
        }

        // Filtering
        if ($request->has('kategori_kos') && $request->kategori_kos != '') {
            $query->where('kategori_kos', $request->kategori_kos);
        }

        if ($request->has('harga_min') && $request->harga_min != '') {
            $query->where('harga', '>=', $request->harga_min);
        }

        if ($request->has('harga_max') && $request->harga_max != '') {
            $query->where('harga', '<=', $request->harga_max);
        }

        $kosan = $query->get();
        return view('kos.kos_market', compact('kosan'));
    }

    public function edit($id_kos)
        {
    $kosan = Kosan::findOrFail($id_kos);
    if ($kosan->id_user !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }
    return view('kos.edit', compact('kosan'));
        }
}
