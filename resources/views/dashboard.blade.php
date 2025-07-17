<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Cuan Manis</title>
  <style>
    /* Style untuk dashboard */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to top, #FFA552, #FFF5E5, #ffffff);
      padding-bottom: 100px;
      margin: 0;
    }

    /* NAVBAR */
    nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #FFF8C4;
      padding: 10px 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .logo {
      height: 40px;
    }

    nav ul {
      display: flex;
      list-style: none;
      gap: 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: #102E50;
      font-weight: 600;
      padding: 8px 12px;
      border-radius: 8px;
      transition: 0.3s;
    }

    nav ul li a:hover {
      background-color: #FFE4C4;
      color: #FF7B00;
    }

    nav ul li a.active {
      background-color: #FFBD59;
      color: #fff;
    }

    h2.center-text {
      text-align: center;
      margin: 30px 0 20px;
      color: #FF7B00;
    }

    /* CONTAINER UTAMA */
    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* SECTION */
    .section {
      width: 100%;
      margin-bottom: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .section h3 {
      text-align: center;
      color: #333;
      margin-bottom: 15px;
      font-size: 24px;
    }

    /* PRODUCT CONTAINER */
    .product-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
      width: 100%;
      max-width: 1100px;
      padding: 10px 0;
      justify-content: center;
    }

    /* PRODUCT CARD */
    .product-card {
      background: #fff;
      border-radius: 12px;
      padding: 15px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
      transition: 0.3s;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      height: 300px; /* Tinggi tetap untuk semua card */
      overflow: hidden; /* Sembunyikan konten yang melebihi batas */
    }

    .product-card:hover {
      transform: scale(1.02);
    }

    .product-card img {
      width: 100%;
      height: 170px; /* Tinggi gambar tetap */
      object-fit: cover; /* Gambar memenuhi area tanpa distorsi */
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .kategori-label {
      display: inline-block;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 8px;
      margin-bottom: 6px;
      background-color: #FFF3D6;
      color: #FF7B00;
    }

    .product-card h4 {
      font-size: 16px;
      font-weight: 600;
      color: #333;
      margin: 4px 0;
    }

    .product-card p {
      font-size: 14px;
      margin: 2px 0;
    }

    .lokasi {
      font-size: 13px;
      color: #666;
    }

    /* FAB */
    .fab {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: #FF7B00;
      color: white;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      font-size: 32px;
      text-align: center;
      line-height: 60px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      z-index: 999;
      transition: transform 0.3s ease;
    }

    .fab.rotate {
      transform: rotate(45deg);
    }

    .fab-options {
      position: fixed;
      bottom: 100px;
      right: 30px;
      display: none;
      flex-direction: column;
      gap: 10px;
      z-index: 998;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .fab-options.show {
      display: flex;
      opacity: 1;
      transform: translateY(0);
    }

    .fab-options a {
      background: #ffffff;
      color: #FF7B00;
      padding: 8px 16px;
      border-radius: 10px;
      text-decoration: none;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      font-weight: 600;
      white-space: nowrap;
      transition: background 0.3s;
    }

    .fab-options a:hover {
      background: #fff4e6;
    }

    /* FOOTER */
    .footer {
      background: #FFF8C4;
      padding: 15px;
      text-align: center;
      color: #102E50;
      font-size: 13px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .dashboard-container {
        padding: 15px;
      }

      .product-container {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
      }

      .product-card {
        height: 280px; /* Sesuaikan tinggi card untuk layar lebih kecil */
      }

      .product-card img {
        height: 150px; /* Sesuaikan tinggi gambar untuk layar lebih kecil */
      }
    }

    @media (max-width: 600px) {
      nav ul li a {
        font-size: 12px;
      }
      .logo {
        height: 30px;
      }

      .product-container {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 10px;
      }

      .product-card {
        height: 250px; /* Sesuaikan tinggi card untuk layar sangat kecil */
      }

      .product-card img {
        height: 120px; /* Sesuaikan tinggi gambar untuk layar sangat kecil */
      }

      .section h3 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <img class="logo" src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis">
    <ul>
      <li><a href="{{ route('barang.market') }}" class="active">Eksplore Preloved</a></li>
      <li><a href="{{ route('kos.market') }}" class="active">Eksplore Kos</a></li>
      <li><a href="{{ route('profile.show') }}">Lihat Profil Saya</a></li>
      <li>
        <form action="{{ route('logout') }}" method="POST" style="display:inline">
          @csrf
          <button type="submit" style="background:none;border:none;padding:0;font:inherit;cursor:pointer;color:#102E50;font-weight:600;padding:8px 12px;border-radius:8px;">
            Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>

  <!-- SALAM -->
  <h2 class="center-text">Hai, {{ Auth::user()->nama }}! 👋</h2>

  <!-- CONTAINER UTAMA -->
  <div class="dashboard-container">
    <!-- Barang -->
    <div class="section">
      <h3>Barang yang Anda Promosikan</h3>
      <div class="product-container">
  @forelse ($barang as $item)
    <div 
            class="product-card" 
            onclick="location.href='{{ route('barang.show', $item->id_barang) }}'"
          >
      <h4>{{ $item->nama_barang }}</h4>
      <img src="{{ asset('storage/uploads/barang/' . $item->foto1) }}" alt="{{ $item->nama_barang }}" style="width:150px; height:auto;">
      <span class="kategori-label">{{ strtoupper($item->kategori_barang) }}</span>
      <p><strong>Rp {{ number_format($item->harga,0,',','.') }}</strong></p>
      <div class="lokasi">📍 {{ $item->lokasi ?? 'Lokasi tidak tersedia' }}</div>
    </div>
  @empty
    <p class="center-text">Belum ada barang yang Anda jual.</p>
  @endforelse
</div>

    </div>

    <!-- Kos -->
          <!-- Kos -->
    <div class="section">
      <h3>Kosan yang Anda Promosikan</h3>
      <div class="product-container">
        @forelse($kosan as $item)
          <div 
            class="product-card" 
            onclick="location.href='{{ route('kos.detail', $item->id_kos) }}'"
          >
            @if($item->foto1)
              <img 
                src="{{ asset('storage/uploads/kosan/' . $item->foto1) }}" 
                alt="{{ $item->nama_kos }}" 
                style="width:150px; height:auto;"
              >
            @endif
            <span class="kategori-label">{{ ucfirst($item->kategori_kos) }}</span>
            <h4>{{ $item->nama_kos }}</h4>
            <p><strong>Rp {{ number_format($item->harga,0,',','.') }}</strong></p>
            <div class="lokasi">
              📍 {{ $item->lokasi ?? 'Lokasi tidak tersedia' }}
            </div>
          </div>
        @empty
          <p class="center-text">Belum ada kos yang dipromosikan.</p>
        @endforelse
      </div>
    </div>


  <!-- FAB -->
  <div class="fab" id="fab" onclick="toggleFab()">+</div>
  <div class="fab-options" id="fabOptions">
    <a href="{{ route('barang.barang.create') }}">Posting Barang</a>
    <a href="{{ route('kos.create') }}">Posting Kos</a>
    <a href="{{ route('dashboard.graph') }}">Lihat Grafik</a> <!-- New button for graph view -->
  </div>

  <!-- FOOTER -->
  <div class="footer">
    © {{ date('Y') }} Cuan Manis – Dibuat oleh mahasiswa, untuk mahasiswa. 🍯
  </div>

  <!-- Script untuk animasi FAB -->
  <script>
    function toggleFab() {
      const fab = document.getElementById('fab');
      const opts = document.getElementById('fabOptions');
      const isOpen = opts.classList.contains('show');

      if (isOpen) {
        opts.classList.remove('show');
        fab.classList.remove('rotate');
      } else {
        opts.classList.add('show');
        fab.classList.add('rotate');
      }
    }
  </script>
</body>
</html>