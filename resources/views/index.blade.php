
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuan Manis | Marketplace Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('css/style_index.css') }}">

</head>
<body>

<!-- NAVIGATION -->
<nav class="main-nav">
  <div class="nav-left">
    <img src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis" class="logo">
  </div>

    <div class="nav-center">
        <ul>
          <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
          <li><a href="{{ route('barang.market') }}" class="nav-link">Eksplore Preloved</a></li>
          <li><a href="{{ route('kos.market') }}" class="nav-link">Eksplore Kost</a></li>
        </ul>
      </div>
  <div class="nav-right">
    <a href="{{ route('login') }}" class="btn-login">Login</a>
    <button id="btnToggleSidebar" onclick="toggleSidebar()"> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
   </svg>
</button>
  </div>
</nav>


<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
  <ul>
    <li><a href="{{ route('home') }}">Home</a></li>
     <li><a href="{{ route('kos.market') }}" class="nav-link">Eksplore Kost</a></li>
                <li><a href="{{ route('barang.market') }}" class="nav-link">Eksplore Preloved</a></li>
    <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
  </ul>


</div>

<!-- HERO -->
<div class="hero">
    <img src="assets/web/logo_header.jpg" alt="Maskot Cuan Manis">
</div>

<!-- FITUR UTAMA -->
<div class="fitur-utama">
    <hr class="section-line">
    <h2>Fitur Utama</h2>
    <div class="fitur-box">
      <div class="box preloved">
          <div class="fitur-card"><div class="oval">1</div><h3>Jual Beli Barang Bekas Mahasiswa</h3></div>
          <div class="fitur-card"><div class="oval">2</div><h3>Upload Barang Kost & Peralatan Harian</h3></div>
          <div class="btn-wrapper"></div>
          <a href="{{ route('barang.market') }}"class="btn-box">Preloved ></a>
      </div>

      <div class="box kostan">
          <div class="fitur-card"><div class="oval">1</div><h3>Posting Kostan-mu</h3></div>
          <div class="fitur-card"><div class="oval">2</div><h3>Cari Kostan-mu</h3></div>
          <div class="btn-wrapper">
          <a href="{{ route('kos.market') }}" class="btn-box kostan-btn">Kostan ></a>
      </div>
    </div>
</div>

<!-- MENGAPA CUAN MANIS -->
<div class="kenapa">
    <hr class="section-line">
    <h3>Mengapa <span>Cuan Manis</span>?</h3>
    <div class="kenapa-box">
        <div class="item">All-in-One Platform</div>
        <div class="item">Mahasiswa Bantu Mahasiswa</div>
        <div class="item">Cepat, Praktis, Aman</div>
    </div>
</div>

<footer>
    © 2025 Cuan Manis – Dibuat oleh mahasiswa, untuk mahasiswa.
</footer>

<!-- SCRIPT TOGGLE -->
<script>
   function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");
  }

  document.addEventListener('click', function(event) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("btnToggleSidebar");

    // Jika klik bukan di sidebar & bukan di tombol toggle
    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
      sidebar.classList.remove("active");
    }
  });

</script>

</body>
</html>