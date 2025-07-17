<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Gunakan CSS yang sama dengan barang/market agar tampilan konsisten */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to top, #FFA552 0%, #fff5e5 30%, #ffffff 80%);
            color: #333;
        }
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FFF8C4;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        nav ul { display: flex; list-style: none; gap: 20px; }
        nav ul li a, nav ul li button { text-decoration: none; color: #102E50; font-weight: 600; padding: 8px 12px; border-radius: 8px; transition: 0.3s; background: none; border: none; cursor: pointer; }
        nav ul li a:hover, nav ul li button:hover { background-color: #FFE4C4; color: #FF7B00; }
        nav ul li a.active { background-color: #FFBD59; color: #fff; }
        .wrapper { flex: 1; display: flex; flex-direction: column; }
        .container { padding: 30px 20px; text-align: center; }
        .filter-container { background: #FFF8C4; padding: 20px; border-radius: 16px; margin: 20px auto; width: 90%; max-width: 1000px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .filter-container form { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: flex-end; }
        .filter-group { display: flex; flex-direction: column; }
        .filter-group label { font-weight: 600; margin-bottom: 6px; color: #102E50; }
        .filter-group select, .filter-group input { padding: 8px 12px; border: 2px solid #FF7B00; border-radius: 8px; outline: none; }
        .filter-group input[type="number"] { width: 120px; }
        .btn-action { background-color: #FF7B00; color: #fff; padding: 10px 20px; border: none; border-radius: 10px; cursor: pointer; font-weight: 600; transition: 0.3s; }
        .btn-action:hover { background-color: #e96d00; }
        .btn-reset { background-color: #FFF; color: #FF7B00; border: 2px solid #FF7B00; }
        .product-container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; padding: 20px; }
        .product-card { background: #fff; border: 2px solid #FF7B00; border-radius: 24px; width: 280px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); padding: 16px; text-align: center; }
        .product-card img { width: 100%; height: 180px; object-fit: cover; border-radius: 16px; }
        .product-card h4 { margin: 12px 0 6px; font-size: 18px; color: #FF7B00; }
        .product-card p { font-size: 16px; color: #102E50; font-weight: bold; }
        .product-card a { display: inline-block; margin-top: 10px; background-color: #FF6B6B; color: #fff; padding: 8px 14px; border-radius: 8px; text-decoration: none; transition: 0.3s; }
        .product-card a:hover { background-color: #e65555; }
        .btn-primary { display: inline-block; background-color: #FF7B00; color: white; padding: 10px 20px; margin: 20px auto; border-radius: 10px; text-decoration: none; font-weight: bold; }
        .btn-primary:hover { background-color: #e96d00; }
        footer { background: #FFF8C4; color: #102E50; padding: 14px; text-align: center; margin-top: auto; font-size: 13px; }
    </style>
</head>
<body>
<nav>
    <img src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis" height="40">
    <ul>
        @auth
        <li><a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li><form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button type="submit">Logout</button></form></li>
        @else
        <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>
</nav>

<div class="wrapper">
    <div class="container">
        <h2>Daftar Kos</h2>
        @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

        <div class="filter-container">
            <form action="{{ route('kos.market') }}" method="GET">
                <div class="filter-group">
                    <label for="search">Cari Kos</label>
                    <input type="text" name="search" id="search" placeholder="Nama atau lokasi" value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label for="kategori">Kategori Kosan</label>
                    <select name="kategori_kos" id="kategori_kos">
                        <option value="">Semua</option>
                        <option value="putra" {{ request('kategori_kos') == 'putra' ? 'selected' : '' }}>Putra</option>
                        <option value="putri" {{ request('kategori_kos') == 'putri' ? 'selected' : '' }}>Putri</option>
                        <option value="campur" {{ request('kategori_kos') == 'campur' ? 'selected' : '' }}>Campur</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Harga Min</label>
                    <input type="number" name="harga_min" value="{{ request('harga_min') }}" placeholder="Rp">
                </div>
                <div class="filter-group">
                    <label>Harga Max</label>
                    <input type="number" name="harga_max" value="{{ request('harga_max') }}" placeholder="Rp">
                </div>
                <button type="submit" class="btn-action">Cari & Filter</button>
                <a href="{{ route('kos.market') }}" class="btn-action btn-reset">Reset</a>
            </form>
        </div>

            <div class="product-container">
            @forelse($kosan as $kos)
                     <div 
            class="product-card" 
            onclick="location.href='{{ route('kos.detail', $kos->id_kos) }}'"
             >
            @if($kos->foto1)
                    <img 
                    src="{{ asset('storage/uploads/kosan/' . $kos->foto1) }}" 
                    alt="{{ $kos->nama_kos }}" 
                    style="width:150px; height:auto;"
                    >
                @endif
                <h4>{{ $kos->nama_kos }}</h4>
                <p>Rp {{ number_format($kos->harga, 0, ',', '.') }}</p>
                </div>
            @empty
                <p>Belum ada kosan tersedia saat ini.</p>
            @endforelse
            </div>


        <a href="{{ url('/') }}" class="btn-primary">Kembali ke Beranda</a>
    </div>
</div>

<footer>&copy; {{ date('Y') }} CuanManis Kos. Semua Hak Dilindungi 🍊</footer>

</body>
</html>