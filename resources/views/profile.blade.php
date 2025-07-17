<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

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
    input[type="email"],
    input[type="file"] {
      width: 100%;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
      margin-bottom: 12px;
      font-family: 'Poppins', sans-serif;
    }

    .profile-img {
      width: 100%;
      max-width: 150px;
      border-radius: 12px;
      margin-bottom: 15px;
      display: block;
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
      margin-top: 10px;
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

    .section-title {
      font-weight: 600;
      color: #FF7B00;
      margin-top: 20px;
      margin-bottom: 6px;
    }
  </style>
</head>
<body>

<div class="container">
 <h2>Profil Saya</h2>

<div>
    <p class="section-title">Foto Profil:</p>
    @if ($user->foto_profil)
        <img src="{{ asset('storage/foto_profil/' . $user->foto_profil) }}" class="profile-img" alt="Foto Profil">
    @else
        <p>Belum ada foto profil.</p>
    @endif
</div>

<div>
    <p class="section-title">Kartu Mahasiswa:</p>
    @if ($user->kartu_mahasiswa)
        <img src="{{ asset('storage/ktm/' . $user->kartu_mahasiswa) }}" class="profile-img" alt="Kartu Mahasiswa">
    @else
        <p>Belum ada kartu mahasiswa.</p>
    @endif
</div>

  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama Lengkap:</label>
    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

    <label>No HP:</label>
    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>

    <label>Foto Profil Baru:</label>
    <input type="file" name="foto_profil" accept="image/*">

    <label>Kartu Mahasiswa Baru:</label>
    <input type="file" name="kartu_mahasiswa" accept="image/*">

    <button type="submit">Update Profil</button>
  </form>

  <div class="back-link">
    <a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a>
  </div>
</div>

</body>
</html>
