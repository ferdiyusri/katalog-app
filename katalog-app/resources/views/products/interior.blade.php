@extends('layouts.frontend')

@section('title', 'Interior')
@section('navbar-class', 'fixed-top')

@section('styles')
<style>
    .alert-terdaftar { background: #d4edda; border: none; border-left: 4px solid #28a745; border-radius: 0; color: #155724; font-size: 0.9rem; padding: 0.85rem 1.5rem; }

    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, #16213e 50%, #0f3460 100%);
        padding: 6rem 0 4rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(201,169,110,0.08) 0%, transparent 50%),
            radial-gradient(ellipse at 80% 20%, rgba(201,169,110,0.05) 0%, transparent 50%);
        pointer-events: none;
    }
    .page-header-geometric { position: absolute; border: 1px solid rgba(201,169,110,0.08); pointer-events: none; }
    .page-header-geometric-1 { width: 300px; height: 300px; top: -80px; right: -80px; transform: rotate(45deg); }
    .page-header-geometric-2 { width: 180px; height: 180px; bottom: -40px; left: 10%; transform: rotate(30deg); }
    .page-header-label {
        display: inline-flex; align-items: center; gap: 0.75rem;
        font-size: 0.75rem; font-weight: 600; letter-spacing: 4px;
        text-transform: uppercase; color: var(--accent); margin-bottom: 0.75rem;
    }
    .page-header-label::before { content: ''; width: 30px; height: 1px; background: var(--accent); }
    .page-header-title { font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700; color: var(--white); margin-bottom: 0.5rem; line-height: 1.2; }
    .page-header-desc { font-size: 0.95rem; color: rgba(255,255,255,0.55); font-weight: 300; max-width: 540px; line-height: 1.8; }

    .filter-bar { background: var(--white); padding: 1.5rem 0; border-bottom: 1px solid rgba(0,0,0,0.06); position: sticky; top: 68px; z-index: 100; box-shadow: 0 2px 15px rgba(0,0,0,0.03); }
    .filter-tabs { display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .filter-tab { background: transparent; border: 1.5px solid rgba(0,0,0,0.1); color: var(--gray); font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; padding: 0.6rem 1.5rem; border-radius: 0; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
    .filter-tab:hover { border-color: var(--accent); color: var(--accent); }
    .filter-tab.active { background: var(--primary); border-color: var(--primary); color: var(--white); }
    .search-box { position: relative; }
    .search-box input { border: 1.5px solid rgba(0,0,0,0.1); border-radius: 0; padding: 0.6rem 1rem 0.6rem 2.8rem; font-size: 0.9rem; font-family: 'DM Sans', sans-serif; width: 280px; transition: all 0.3s ease; background: var(--light); }
    .search-box input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,169,110,0.1); }
    .search-box i { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray); font-size: 0.9rem; }
    .product-count { font-size: 0.88rem; color: var(--gray); font-weight: 400; }
    .product-count strong { color: var(--primary); font-weight: 700; }

    .products-section { padding: 3rem 0 6rem; }
    .product-card { background: var(--white); border: none; border-radius: 0; overflow: hidden; transition: all 0.4s ease; box-shadow: 0 2px 15px rgba(0,0,0,0.04); height: 100%; position: relative; }
    .product-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); }
    .product-card-img-wrapper { position: relative; height: 260px; overflow: hidden; background: linear-gradient(135deg, #f0ebe3, #e8e0d4); display: flex; align-items: center; justify-content: center; }
    .product-card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .product-card:hover .product-card-img-wrapper img { transform: scale(1.06); }
    .product-card-badge { position: absolute; top: 1rem; left: 1rem; background: var(--accent); color: var(--primary); font-size: 0.7rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 0.35rem 0.9rem; z-index: 2; }
    .product-card-badge.sipil { background: var(--primary); color: var(--white); }
    .product-card-body { padding: 1.5rem; }
    .product-card-category { font-size: 0.72rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: var(--accent); margin-bottom: 0.5rem; }
    .product-card-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem; }
    .product-card-desc { font-size: 0.88rem; color: var(--gray); line-height: 1.6; font-weight: 300; margin-bottom: 1rem; }
    .product-card-price { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: var(--primary); }
    .btn-daftar-harga { display: inline-flex; align-items: center; gap: 0.4rem; background: transparent; border: 1.5px solid var(--accent); color: var(--accent); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.5px; padding: 0.4rem 0.9rem; cursor: pointer; transition: all 0.3s ease; border-radius: 0; white-space: nowrap; }
    .btn-daftar-harga:hover { background: var(--accent); color: var(--primary); }
    .product-card-link { display: inline-flex; align-items: center; gap: 0.5rem; color: var(--accent); font-weight: 600; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; transition: all 0.3s ease; }
    .product-card-link:hover { gap: 0.8rem; color: var(--primary); }

    .empty-state { text-align: center; padding: 5rem 2rem; border: 2px dashed rgba(201,169,110,0.25); background: rgba(201,169,110,0.03); }
    .empty-state i { font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem; opacity: 0.4; }
    .empty-state h3 { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--primary); margin-bottom: 0.5rem; }
    .empty-state p { color: var(--gray); font-size: 1rem; font-weight: 300; }

    .pagination-custom { display: flex; gap: 0.5rem; justify-content: center; margin-top: 3rem; }
    .pagination-custom .page-link { border: 1.5px solid rgba(0,0,0,0.1); border-radius: 0; color: var(--primary); font-weight: 600; font-size: 0.88rem; padding: 0.6rem 1rem; transition: all 0.3s ease; }
    .pagination-custom .page-link:hover,
    .pagination-custom .page-item.active .page-link { background: var(--primary); border-color: var(--primary); color: var(--white); }

    .fade-up { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 768px) {
        .page-header { padding: 5rem 0 2.5rem; }
        .page-header-title { font-size: 1.8rem; }
        .page-header-desc { font-size: 0.88rem; }
        .page-header-geometric-1, .page-header-geometric-2 { display: none; }
        .filter-bar { position: relative; top: auto; padding: 0.75rem 0; }
        .filter-bar .d-flex { flex-direction: column; gap: 0.75rem; align-items: flex-start !important; }
        .filter-tabs { flex-wrap: wrap; gap: 0.5rem; }
        .filter-tab { padding: 0.4rem 0.9rem; font-size: 0.75rem; }
        .search-box { width: 100%; }
        .search-box input { width: 100%; }
        .product-count { font-size: 0.8rem; }
        .product-card-img-wrapper { height: 200px; }
        .products-section { padding: 2rem 0 3rem; }
    }
    @media (max-width: 480px) {
        .page-header { padding: 5rem 0 2rem; }
        .page-header-title { font-size: 1.5rem; }
        .filter-tab { padding: 0.35rem 0.75rem; font-size: 0.72rem; }
        .product-card-img-wrapper { height: 170px; }
    }
</style>
@endsection

@section('content')
    @if(session('terdaftar'))
    <div class="alert-terdaftar d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill" style="color:#28a745;"></i>
        Pendaftaran berhasil! Anda sekarang dapat melihat harga semua produk kami.
    </div>
    @endif

    <section class="page-header">
        <div class="page-header-geometric page-header-geometric-1"></div>
        <div class="page-header-geometric page-header-geometric-2"></div>
        <div class="container position-relative">
            <div class="page-header-label">Koleksi Interior</div>
            <h1 class="page-header-title">Interior</h1>
            <p class="page-header-desc">Temukan koleksi furnitur, dekorasi, pencahayaan, dan semua kebutuhan desain interior berkualitas tinggi.</p>
        </div>
    </section>

    <div class="filter-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="filter-tabs">
                    <a href="{{ route('products.index') }}" class="filter-tab">Semua</a>
                    <a href="{{ route('products.interior') }}" class="filter-tab active">Interior</a>
                    <a href="{{ route('products.builddesain') }}" class="filter-tab">Build &amp; Desain</a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="product-count"><strong>{{ $products->count() }}</strong> produk ditemukan</span>
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Cari produk..." id="searchInput">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="products-section">
        <div class="container">
            <div class="row g-4 fade-up" id="productGrid">
                @forelse($products as $product)
                <div class="col-md-6 col-lg-4 product-item" data-name="{{ strtolower($product->name) }}">
                    <div class="product-card">
                        <div class="product-card-img-wrapper">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <i class="bi bi-image" style="font-size:2.5rem; color:var(--accent); opacity:0.3;"></i>
                            @endif
                            <span class="product-card-badge {{ $product->category == 'sipil' ? 'sipil' : '' }}">
                                {{ $product->category_label }}
                            </span>
                        </div>
                        <div class="product-card-body">
                            <div class="product-card-category">{{ ucfirst($product->category) }}</div>
                            <h3 class="product-card-title">{{ $product->name }}</h3>
                            <p class="product-card-desc">{{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if(session('harga_member'))
                                    @if($product->price)
                                    <span class="product-card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @else
                                    <span></span>
                                    @endif
                                @else
                                <button type="button" class="btn-daftar-harga" data-bs-toggle="modal" data-bs-target="#modalDaftarHarga">
                                    <i class="bi bi-lock-fill"></i> Lihat Harga
                                </button>
                                @endif
                                <a href="{{ route('products.show', $product) }}" class="product-card-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-lamp"></i>
                        <h3>Belum Ada Produk Interior</h3>
                        <p>Produk interior belum tersedia. Silakan tambahkan melalui panel admin.</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if(method_exists($products, 'links'))
            <div class="pagination-custom">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- MODAL DAFTAR HARGA -->
    <div class="modal fade" id="modalDaftarHarga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; overflow:hidden; border:none; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <div class="modal-header" style="background:var(--primary); border-bottom:2px solid var(--accent); padding:1.25rem 1.75rem;">
                    <h5 class="modal-title" style="font-family:'Playfair Display',serif; color:#fff; font-size:1.1rem; font-weight:700;">
                        <i class="bi bi-tag me-2" style="color:var(--accent);"></i>Daftar untuk Melihat Harga
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                </div>
                <div class="modal-body" style="background:var(--light); padding:1.75rem;">
                    <p style="font-size:0.85rem; color:var(--gray); margin-bottom:1.25rem; line-height:1.7;">
                        Daftarkan diri Anda untuk mendapatkan akses penuh ke informasi harga seluruh produk HIKO STUDIO.
                    </p>
                    <form method="POST" action="{{ route('harga.daftar') }}">
                        @csrf
                        <div class="mb-3">
                            <label style="font-size:0.72rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--primary); display:block; margin-bottom:0.35rem;">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" style="border-radius:8px; border:1.5px solid rgba(0,0,0,0.1);" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="mb-3">
                            <label style="font-size:0.72rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--primary); display:block; margin-bottom:0.35rem;">Email</label>
                            <input type="email" name="email" class="form-control" style="border-radius:8px; border:1.5px solid rgba(0,0,0,0.1);" placeholder="Contoh: budi@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label style="font-size:0.72rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--primary); display:block; margin-bottom:0.35rem;">No. Telepon</label>
                            <input type="tel" name="telpon" class="form-control" style="border-radius:8px; border:1.5px solid rgba(0,0,0,0.1);" placeholder="Contoh: 08123456789" required>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="button" class="btn btn-outline-secondary" style="border-radius:8px;" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn" style="background:var(--accent); color:var(--primary); font-weight:700; border-radius:8px; letter-spacing:1px;">
                                <i class="bi bi-check-lg me-1"></i> Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    window.addEventListener('scroll', function() {
        document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
    });
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.product-item').forEach(item => {
                item.style.display = item.getAttribute('data-name').includes(query) ? '' : 'none';
            });
        });
    }
</script>
@endsection
