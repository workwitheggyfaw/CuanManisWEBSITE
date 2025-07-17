<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Cuan Manis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #FFFDF6;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FFF8C4;
            padding: 14px 5%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        nav .logo { height: 50px; }
        nav ul {
            display: flex;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }
        nav ul li a:hover { color: #FF7B00; }
        .btn-login {
            background-color: #FF7B00;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-login:hover { background-color: #e96d00; }
        .register-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .register-container h2 {
            text-align: center;
            color: #FF7B00;
            margin-bottom: 24px;
        }
        .register-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #FFBD59;
            border-radius: 10px;
        }
        .register-container button {
            background: #FF7B00;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
            cursor: pointer;
        }
        .register-container button:hover { background: #e96d00; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #FFF8C4;
            color: #333;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<nav>
    <img src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis" class="logo">
    <ul>
        <li><a href="{{ route('dashboard') }}">Kembali ke dashboard</a></li>
        <li><a href="#">Eksplore Kost</a></li>
        <li><a href="#">Eksplore Preloved</a></li>
    </ul>
    <a href="{{ route('login') }}" class="btn-login">Login</a>
</nav>

{{-- <div class="register-container">
    <h2>Daftar Akun Baru</h2>
    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="no_hp" placeholder="Nomor HP" required>

        <label>Upload Foto Profil (Opsional)</label>
        <input type="file" name="foto_profil">

        <label>Upload KTM (Wajib)</label>
        <input type="file" name="kartu_mahasiswa" required>

        <button type="submit">Daftar</button>
    </form>

    <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Halaman Utama</a>
</div> --}}


<div class="register-container">
    <h2>Daftar Akun Baru</h2>

    {{-- Tampilkan semua error --}}
    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input
          type="text"
          name="nama"
          placeholder="Nama Lengkap"
          value="{{ old('nama') }}"
          required
        >
        @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <input
          type="email"
          name="email"
          placeholder="Email"
          value="{{ old('email') }}"
          required
        >
        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <input
          type="password"
          name="password"
          placeholder="Password"
          required
        >
        @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <input
          type="password"
          name="password_confirmation"
          placeholder="Konfirmasi Password"
          required
        >

        <input
          type="text"
          name="no_hp"
          placeholder="Nomor HP"
          value="{{ old('no_hp') }}"
          required
        >
        @error('no_hp') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <label class="mt-4 block font-medium">Upload Foto Profil (Opsional)</label>
        <input type="file" name="foto_profil" accept="image/*">
        @error('foto_profil') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <label class="mt-4 block font-medium">Upload KTM (Wajib)</label>
        <input type="file" name="kartu_mahasiswa" accept="image/*" required>
        @error('kartu_mahasiswa') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <button type="submit">Daftar</button>
    </form>

    <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Halaman Utama</a>
</div>

<footer>
    © 2025 Cuan Manis – Dibuat oleh mahasiswa, untuk mahasiswa.
</footer>

</body>
</html>
