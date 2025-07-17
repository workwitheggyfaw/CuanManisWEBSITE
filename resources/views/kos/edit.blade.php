<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kos - Cuan Manis</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
  <h2>Edit Kos</h2>

  <form action="{{ route('kos.update', $kosan->id_kos) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nama Kos:</label>
    <input type="text" name="nama_kos" value="{{ old('nama_kos', $kosan->nama_kos) }}" required>
    @error('nama_kos') <div class="error">{{ $message }}</div> @enderror

    <label>Kategori:</label>
    <select name="kategori_kos" required>
      <option value="putra" {{ old('kategori_kos', $kosan->kategori_kos) == 'putra' ? 'selected' : '' }}>Putra</option>
      <option value="putri" {{ old('kategori_kos', $kosan->kategori_kos) == 'putri' ? 'selected' : '' }}>Putri</option>
      <option value="campur" {{ old('kategori_kos', $kosan->kategori_kos) == 'campur' ? 'selected' : '' }}>Campur</option>
    </select>
    @error('kategori_kos') <div class="error">{{ $message }}</div> @enderror

    <label>Lokasi:</label>
    <input type="text" name="lokasi" value="{{ old('lokasi', $kosan->lokasi) }}" required>
    @error('lokasi') <div class="error">{{ $message }}</div> @enderror

    <label>Alamat Lengkap:</label>
    <textarea name="alamat" required>{{ old('alamat', $kosan->alamat) }}</textarea>
    @error('alamat') <div class="error">{{ $message }}</div> @enderror

    <label>Harga / bulan:</label>
    <input type="number" name="harga" value="{{ old('harga', $kosan->harga) }}" required>
    @error('harga') <div class="error">{{ $message }}</div> @enderror

    <label>Nama Pemilik Kos:</label>
    <input type="text" name="nama_pemilik_kos" value="{{ old('nama_pemilik_kos', $kosan->nama_pemilik_kos) }}" required>
    @error('nama_pemilik_kos') <div class="error">{{ $message }}</div> @enderror

    <label>No. Telepon:</label>
    <input type="text" name="no_telepon" value="{{ old('no_telepon', $kosan->no_telepon) }}" required>
    @error('no_telepon') <div class="error">{{ $message }}</div> @enderror

    <label>Upload Foto (max 6):</label>
    @for ($i = 1; $i <= 6; $i++)
      <input type="file" name="foto{{ $i }}" accept="image/*">
      @error('foto' . $i) <div class="error">{{ $message }}</div> @enderror
    @endfor

    <button type="submit">Update Kos</button>
  </form>

  <div class="back-link">
      <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali</a>
  </div>
</div>

</body>
</html>