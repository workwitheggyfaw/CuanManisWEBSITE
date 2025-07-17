<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Barang</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; font-family: 'Poppins', sans-serif; background: linear-gradient(to top, #FFA552, #fff5e5, #ffffff); color: #333; }
    body { display: flex; flex-direction: column; }
    nav { display: flex; align-items: center; justify-content: space-between; background-color: #FFF8C4; padding: 10px 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 999; }
    nav ul { display: flex; list-style: none; gap: 20px; }
    nav ul li a, nav ul li form button { text-decoration: none; color: #102E50; font-weight: 600; padding: 8px 12px; border-radius: 8px; transition: 0.3s; background: none; border: none; cursor: pointer; }
    nav ul li a:hover, nav ul li form button:hover { background-color: #FFE4C4; color: #FF7B00; }
    nav ul li a.active { background-color: #FFBD59; color: #fff; }
    .main-content { flex: 1; padding-bottom: 30px; }
    .detail-container { max-width: 800px; margin: 40px auto; padding: 30px; border-radius: 16px; background: #fff; box-shadow: 0 6px 16px rgba(0,0,0,0.1); }
    .detail-container h2 { color: #FF7B00; margin-bottom: 10px; }
    .detail-container p { margin: 8px 0; font-size: 16px; }
    .image-preview { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 16px; }
    .image-preview img { width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 2px solid #FFBD59; cursor: pointer; transition: transform .2s; }
    .image-preview img:hover { transform: scale(1.05); }
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); justify-content: center; align-items: center; z-index: 1000; }
    .modal.active { display: flex; }
    .modal-content { position: relative; max-width: 90%; max-height: 90%; }
    .modal-content img { display: block; max-width: 100%; max-height: 100%; border-radius: 8px; }
    .modal-close, .modal-download, .modal-nav { position: absolute; background: rgba(255,255,255,0.9); border: none; border-radius: 4px; font-weight: 600; cursor: pointer; transition: background .2s; padding: 6px 12px; }
    .modal-close:hover, .modal-download:hover, .modal-nav:hover { background: rgba(255,255,255,1); }
    .modal-close { top: 10px; right: 10px; }
    .modal-download { top: 10px; right: 90px; text-decoration: none; color: #102E50; }
    .modal-nav { top: 50%; transform: translateY(-50%); font-size: 24px; padding: 10px; }
    .modal-nav.prev { left: 10px; }
    .modal-nav.next { right: 10px; }
    .btn-primary { display: inline-block; margin: 12px 8px; padding: 10px 20px; background-color: #FF7B00; color: white; text-decoration: none; border: none; border-radius: 8px; font-weight: bold; text-align: center; transition: 0.3s; cursor: pointer; line-height: 1; }
    .btn-primary:hover { background-color: #e96d00; }
    .btn-primary.disabled { opacity: 0.6; pointer-events: none; }
    .tombol-wrapper { text-align: center; margin-top: 40px; }
    footer { background: #FFF8C4; color: #102E50; padding: 14px; text-align: center; font-size: 13px; margin-top: auto; }
  </style>
</head>
<body>

<nav>
  <img src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis" height="40">
  <ul>
    @auth
      <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard')?'active':'' }}">Dashboard</a></li>
      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit">Logout</button>
        </form>
      </li>
    @else
      <li><a href="{{ route('login') }}">Login</a></li>
    @endauth
  </ul>
</nav>

<div class="main-content">
  <div class="detail-container">
    <h2>{{ $barang->nama_barang }}</h2>
    <p><strong>Kategori:</strong> {{ $barang->kategori_barang }}</p>
    <p><strong>Lokasi:</strong> {{ $barang->lokasi }}</p>
    <p><strong>Harga:</strong> {{ 'Rp ' . number_format($barang->harga, 0, ',', '.') }}</p>
    <p><strong>Kontak:</strong> {{ $barang->no_telepon ?? '-' }}</p>
    <p><strong>Kondisi:</strong> {{ $barang->kondisi_barang }}</p>
    <p><strong>Foto barang:</strong></p>

      <div class="image-preview">
        @php $images = []; @endphp
        @for($i = 1; $i <= 6; $i++)
          @php $f = 'foto' . $i; @endphp
          @if(!empty($barang->$f))
            @php $url = asset('storage/uploads/barang/' . $barang->$f); $images[] = $url; @endphp
            <img src="{{ $url }}" data-index="{{ count($images)-1 }}" alt="Foto {{ $i }}">
          @endif
        @endfor
      </div>

    <div class="tombol-wrapper">
      @if($barang->no_telepon && Auth::id() != $barang->id_user)
        <a href="{{ $barang->whatsapp_link }}" class="btn-primary" target="_blank">Hubungi sekarang</a>
      @elseif(Auth::id() == $barang->id_user)
        <span class="btn-primary disabled">Ini barang Anda</span>
      @else
        <span class="btn-primary disabled">Kontak tidak tersedia</span>
      @endif
      <a href="{{ route('barang.market') }}" class="btn-primary">Kembali ke Eksplore Preloved</a>
      @auth
        @if(Auth::id() == $barang->id_user)
          <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn-primary">Edit</a>
          <form action="{{ route('barang.delete', $barang->id_barang) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn-primary" onclick="return confirm('Yakin hapus?')">Hapus</button>
          </form>
        @endif
      @endauth
    </div>
  </div>
</div>

<div id="lightboxModal" class="modal">
  <div class="modal-content">
    <button class="modal-close" id="closeBtn">&times;</button>
    <a id="downloadBtn" class="modal-download" href="#" download>Download</a>
    <button class="modal-nav prev" id="prevBtn">&#10094;</button>
    <button class="modal-nav next" id="nextBtn">&#10095;</button>
    <img src="" alt="Gambar Besar" id="lightboxImg">
  </div>
</div>

<footer>
  &copy; {{ date('Y') }} CuanManis Barang. Semua Hak Dilindungi 🍊
</footer>

<script>
  const images = @json($images);
  const modal = document.getElementById('lightboxModal');
  const lightboxImg = document.getElementById('lightboxImg');
  const downloadBtn = document.getElementById('downloadBtn');
  const closeBtn = document.getElementById('closeBtn');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  let currentIndex = 0;

  function openModal(idx) {
    currentIndex = idx;
    const url = images[currentIndex];
    lightboxImg.src = url;
    downloadBtn.href = url;
    downloadBtn.download = url.split('/').pop();
    modal.classList.add('active');
  }
  function showPrev() { if (currentIndex > 0) openModal(currentIndex - 1); }
  function showNext() { if (currentIndex < images.length - 1) openModal(currentIndex + 1); }

  document.querySelectorAll('.image-preview img').forEach(img => {
    img.addEventListener('click', () => openModal(parseInt(img.dataset.index)));
  });
  closeBtn.addEventListener('click', () => modal.classList.remove('active'));
  prevBtn.addEventListener('click', showPrev);
  nextBtn.addEventListener('click', showNext);
  modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('active'); });
  document.addEventListener('keydown', e => {
    if (!modal.classList.contains('active')) return;
    if (e.key === 'ArrowLeft') showPrev();
    if (e.key === 'ArrowRight') showNext();
    if (e.key === 'Escape') modal.classList.remove('active');
  });
</script>

</body>
</html>
