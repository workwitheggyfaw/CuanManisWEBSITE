<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    // Menampilkan semua data barang dalam bentuk JSON
    public function index()
    {
        $barang = Barang::with('user')->latest()->get();
        return response()->json($barang);
    }

public function market(Request $request)
{
    // 1) Validasi input
    $request->validate([
        'search'          => 'nullable|string',
        'kategori_barang' => 'nullable|string',
        'harga_min'       => 'nullable|numeric',
        'harga_max'       => 'nullable|numeric',
    ]);

    $query = Barang::query();

    // 2) Searching
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use($search) {
            $q->where('nama_barang', 'like', "%{$search}%")
              ->orWhere('lokasi',      'like', "%{$search}%");
        });
    }

    // 3) Filtering kategori
    if ($request->filled('kategori_barang')) {
        $query->where('kategori_barang', $request->kategori_barang);
    }

    // 4) Filtering harga
    if ($request->filled('harga_min')) {
        $query->where('harga', '>=', (float)$request->harga_min);
    }
    if ($request->filled('harga_max')) {
        $query->where('harga', '<=', (float)$request->harga_max);
    }

    // 5) Ambil list kategori & paginate
    $listKategori = Barang::select('kategori_barang')
                         ->distinct()
                         ->pluck('kategori_barang');

    $barang = $query->orderBy('created_at', 'desc')
                     ->paginate(12)
                     ->withQueryString();

    return view('barang.market', compact('barang', 'listKategori'));
}



        public function create()
{
    return view('barang.form',  ['barang' => null]);
}
 
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_barang' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'harga' => 'required|integer',
        'no_telepon' => 'required|string|max:20',
        'kondisi_barang' => 'required|in:baru,bekas',
        'foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $validated;
    $data['id_user'] = Auth::id();

    // Inisialisasi 6 kolom foto menjadi null
    for ($i = 1; $i <= 6; $i++) {
        $data["foto$i"] = null;
    }

    // Simpan file yang diupload
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $index => $file) {
            if ($index < 6) {
                $originalName = $file->getClientOriginalName();
                $file->storeAs('uploads/barang', $originalName, 'public'); // simpan dengan nama asli
                $data["foto" . ($index + 1)] = $originalName; // simpan hanya nama file di DB
            }
        }
    }

    // Simpan data barang ke database
    Barang::create($data);

    return redirect()->route('barang.market')->with('success', 'Barang berhasil ditambahkan.');
}


    // Menampilkan detail barang ke view
    public function show($id_barang)
    {
        $barang = Barang::with('user')->where('id_barang', $id_barang)->firstOrFail();
        return view('barang.show', compact('barang'));
    }

    // Update data barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->id_user !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke barang ini.');
        }

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_barang' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|integer',
            'no_telepon' => 'required|string|max:20',
            'kondisi_barang' => 'required|in:baru,bekas',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($index < 6) {
                    $path = $file->store('uploads/barang', 'public');
                    $data["foto" . ($index + 1)] = $path;
                }
            }
        }

        $barang->update($data);
        return redirect()->back()->with('success', 'Barang berhasil diperbarui');
    }

    // Hapus barang + foto dari storage
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->id_user !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke barang ini.');
        }

        for ($i = 1; $i <= 6; $i++) {
            $foto = "foto$i";
            if ($barang->$foto) {
                Storage::disk('public')->delete($barang->$foto);
            }
        }

        $barang->delete();
        return redirect()->route('barang.market')->with('success', 'Barang berhasil dihapus');
    }


    public function edit($id_barang)
        {
    $barang = Barang::findOrFail($id_barang);
    if ($barang->id_user !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }
    return view('barang.edit', compact('barang'));
        }
}