<!DOCTYPE html>
<html>
<head>
    <title>{{ $barang ? 'Edit Barang' : 'Tambah Barang' }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to top, #FFA552, #FFF5E5, #ffffff);
            padding: 30px 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #FF7B00;
        }
        label {
            display: block;
            margin: 12px 0 6px;
            font-weight: 600;
            color: #102E50;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        input[type="file"] {
            margin-bottom: 8px;
        }
        button {
            display: block;
            width: 100%;
            background-color: #FF7B00;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background-color: #e76a00;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            text-decoration: none;
            color: #102E50;
            font-size: 14px;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $barang ? 'Edit Barang' : 'Tambah Barang' }}</h2>

        @if($barang)
            <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>

            <label>Kategori:</label>
            <select name="kategori_barang" required>
              <option value="">-- Pilih Kategori --</option>
              @php
                $kategoriList = [
                  'Elektronik', 'Fashion pria', 'Fashion wanita', 'Sport', 'Gadget',
                  'Perabotan rumah', 'Buku dan alat tulis', 'Perlengkapan event/organisasi',
                  'Personal care', 'Kendaraan'
                ];
              @endphp
              @foreach($kategoriList as $kategori)
                <option value="{{ $kategori }}" {{ old('kategori_barang') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
              @endforeach
            </select>


            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $barang->lokasi ?? '') }}" required>

            <label for="harga">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $barang->harga ?? '') }}" required>

            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" value="{{ old('no_telepon', $barang->no_telepon ?? '') }}" required>

            <label for="kondisi_barang">Kondisi Barang</label>
            <select name="kondisi_barang" required>
                <option value="baru" {{ old('kondisi_barang', $barang->kondisi_barang ?? '') == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="bekas" {{ old('kondisi_barang', $barang->kondisi_barang ?? '') == 'bekas' ? 'selected' : '' }}>Bekas</option>
            </select>

            <label for="foto">Foto (maksimal 6)</label>
              <input type="file" name="foto[]" multiple accept="image/jpeg,image/png,image/jpg">
              <small>Anda dapat mengupload hingga 6 foto.</small>

              @if($barang)
                  <div style="margin-top: 20px;">
                      <h3>Foto Saat Ini:</h3>
                      @for($i = 1; $i <= 6; $i++)
                          @if($barang->{'foto' . $i})
                              <img src="{{ asset('storage/uploads/barang/' . $barang->{'foto' . $i}) }}" alt="Foto {{ $i }}" style="width:100px; height:auto; margin-right:10px; margin-bottom:10px;">
                          @endif
                      @endfor
                  </div>
              @endif

            <button type="submit">{{ $barang ? 'Update Barang' : 'Tambah Barang' }}</button>
        </form>

        <div class="back-link">
            <a href="{{ route('barang.market') }}">Kembali ke Market</a>
        </div>
    </div>
</body>
</html>