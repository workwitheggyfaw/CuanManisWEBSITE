<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ isset($kos) ? 'Edit Kos' : 'Posting Kos' }} - Cuan Manis</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* CSS tetap seperti versi asli */
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
    input[type="text"], input[type="number"], select, textarea {
      width: 100%;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
      margin-bottom: 10px;
      font-family: 'Poppins', sans-serif;
    }
    textarea { height: 100px; resize: vertical; }
    input[type="file"] { margin-bottom: 8px; }
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
    button:hover { background-color: #e76a00; }
    .back-link {
      text-align: center;
      margin-top: 20px;
    }
    .back-link a {
      text-decoration: none;
      color: #102E50;
      font-size: 14px;
    }
    .back-link a:hover { text-decoration: underline; }
    .error {
      color: red;
      font-size: 12px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>{{ isset($kos) ? 'Edit Kos' : 'Posting Kos Baru' }}</h2>

  <form action="{{ isset($kos) ? url('/kos/' . $kos->id) : route('kos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($kos))
      @method('PUT')
    @endif

    <label>Nama Kos:</label>
    <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos ?? '') }}" required>
    @error('nama_kos') <div class="error">{{ $message }}</div> @enderror

    <label>Kategori:</label>
    <select name="kategori_kos" required>
      <option value="putra" {{ old('kategori_kos', $kos->kategori_kos ?? '') == 'putra' ? 'selected' : '' }}>Putra</option>
      <option value="putri" {{ old('kategori_kos', $kos->kategori_kos ?? '') == 'putri' ? 'selected' : '' }}>Putri</option>
      <option value="campur" {{ old('kategori_kos', $kos->kategori_kos ?? '') == 'campur' ? 'selected' : '' }}>Campur</option>
    </select>
    @error('kategori_kos') <div class="error">{{ $message }}</div> @enderror

    <label>Lokasi:</label>
    <input type="text" name="lokasi" value="{{ old('lokasi', $kos->lokasi ?? '') }}" required>
    @error('lokasi') <div class="error">{{ $message }}</div> @enderror

    <label>Alamat Lengkap:</label>
    <textarea name="alamat" required>{{ old('alamat', $kos->alamat ?? '') }}</textarea>
    @error('alamat') <div class="error">{{ $message }}</div> @enderror

    <label>Harga / bulan:</label>
    <input type="number" name="harga" value="{{ old('harga', $kos->harga ?? '') }}" required>
    @error('harga') <div class="error">{{ $message }}</div> @enderror

    <label>Nama Pemilik Kos:</label>
    <input type="text" name="nama_pemilik_kos" value="{{ old('nama_pemilik_kos', $kos->nama_pemilik_kos ?? '') }}" required>
    @error('nama_pemilik_kos') <div class="error">{{ $message }}</div> @enderror

    <label>No. Telepon:</label>
    <input type="text" name="no_telepon" value="{{ old('no_telepon', $kos->no_telepon ?? '') }}" required>
    @error('no_telepon') <div class="error">{{ $message }}</div> @enderror

    <<label for="foto">Upload Foto (maksimal 6)</label>
    <input 
        type="file" 
        name="foto[]" 
        multiple 
        accept="image/jpeg,image/png,image/jpg" 
    >
    <small>Anda dapat mengupload hingga 6 foto.</small>

    @foreach (range(1,6) as $i)
      @error("foto.$i") 
        <div class="error">{{ $message }}</div> 
      @enderror
    @endforeach

    @if(isset($kos) && $kos->foto1)
      <div style="margin-top:20px;">
        <h3>Foto Saat Ini:</h3>
        @for($i=1; $i<=6; $i++)
          @php $f = 'foto'.$i; @endphp
          @if($kos->$f)
            <img 
              src="{{ asset('storage/uploads/kosan/' . $kos->$f) }}" 
              alt="Foto {{ $i }}" 
              style="width:100px; margin:5px;"
            >
          @endif
        @endfor
      </div>
    @endif


    <button type="submit">{{ isset($kos) ? 'Update Kos' : 'Posting Kos' }}</button>
  </form>

  <div class="back-link">
    <a href="{{ url('/kos') }}">← Kembali ke Daftar Kos</a>
  </div>
</div>

</body>
</html>
