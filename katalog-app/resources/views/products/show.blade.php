@extends('layouts.frontend')

@section('title', $product->name)

@section('styles')
<style>
    .detail-section { padding: 4rem 0; }

    .product-img-wrap {
        background: #fff;
        border-radius: 2px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,0.1);
        aspect-ratio: 4/3;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .product-img-placeholder { font-size: 5rem; color: var(--accent); opacity: 0.2; }

    .product-badge {
        display: inline-block;
        background: var(--accent);
        color: var(--primary);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.3rem 1rem;
        margin-bottom: 1rem;
    }

    .product-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .product-price {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--accent);
        margin-bottom: 1.5rem;
    }

    .btn-daftar-harga {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: transparent; border: 1.5px solid var(--accent);
        color: var(--accent); font-size: 0.88rem; font-weight: 600;
        letter-spacing: 0.5px; padding: 0.65rem 1.5rem;
        cursor: pointer; transition: all 0.3s ease; border-radius: 0;
        margin-bottom: 1.5rem;
    }
    .btn-daftar-harga:hover { background: var(--accent); color: var(--primary); }
    .alert-terdaftar { background: #d4edda; border: none; border-left: 4px solid #28a745; border-radius: 0; color: #155724; font-size: 0.9rem; padding: 0.85rem 1.5rem; }

    .divider-gold { width: 50px; height: 2px; background: var(--accent); margin: 1.2rem 0; }

    .product-desc { font-size: 1rem; color: #555; line-height: 1.8; margin-bottom: 2rem; }

    .info-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        font-size: 0.92rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #888; min-width: 100px; }
    .info-value { font-weight: 600; color: var(--primary); }

    .btn-back {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: transparent; border: 1.5px solid var(--primary);
        color: var(--primary); font-size: 0.85rem; font-weight: 600;
        letter-spacing: 1px; text-transform: uppercase;
        padding: 0.7rem 1.6rem; text-decoration: none; transition: all 0.3s ease;
    }
    .btn-back:hover { background: var(--primary); color: var(--white); }

    .btn-wa {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: #25d366; color: #fff; font-size: 0.85rem; font-weight: 600;
        letter-spacing: 1px; text-transform: uppercase;
        padding: 0.7rem 1.6rem; text-decoration: none; transition: all 0.3s ease; border: none;
    }
    .btn-wa:hover { background: #1ebe5d; color: #fff; }

    @media (max-width: 768px) {
        .product-title { font-size: 1.6rem; }
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

    <section class="detail-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="product-img-wrap">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <i class="bi bi-image product-img-placeholder"></i>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="product-badge">{{ ucfirst($product->category ?? 'Produk') }}</span>
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <div class="divider-gold"></div>

                    @if(session('harga_member'))
                        @if($product->price > 0)
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        @else
                        <div class="product-price" style="font-size:1.1rem;color:#888;">Hubungi kami untuk harga</div>
                        @endif
                    @else
                    <button type="button" class="btn-daftar-harga" data-bs-toggle="modal" data-bs-target="#modalDaftarHarga">
                        <i class="bi bi-lock-fill"></i> Daftar untuk Melihat Harga
                    </button>
                    @endif

                    <p class="product-desc">{{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>

                    <div class="mb-4">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-tag me-2"></i>Kategori</span>
                            <span class="info-value">{{ $product->category ? ucwords(str_replace('-', ' ', $product->category)) : '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-check-circle me-2"></i>Ketersediaan</span>
                            <span class="info-value" style="color:#2ecc71;">Tersedia</span>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="https://wa.me/6285111417001?text=Halo%20HIKO%20STUDIO%2C%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}" target="_blank" class="btn-wa">
                            <i class="bi bi-whatsapp"></i> Tanya via WhatsApp
                        </a>
                        <a href="{{ url()->previous() }}" class="btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL DAFTAR HARGA -->
    <div class="modal fade" id="modalDaftarHarga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px;overflow:hidden;border:none;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <div class="modal-header" style="background:var(--primary);border-bottom:2px solid var(--accent);padding:1.25rem 1.75rem;">
                    <h5 class="modal-title" style="font-family:'Playfair Display',serif;color:#fff;font-size:1.1rem;font-weight:700;">
                        <i class="bi bi-tag me-2" style="color:var(--accent);"></i>Daftar untuk Melihat Harga
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                </div>
                <div class="modal-body" style="background:var(--light);padding:1.75rem;">
                    <p style="font-size:0.85rem;color:var(--gray);margin-bottom:1.25rem;line-height:1.7;">
                        Daftarkan diri Anda untuk mendapatkan akses penuh ke informasi harga seluruh produk HIKO STUDIO.
                    </p>
                    <form method="POST" action="{{ route('harga.daftar') }}">
                        @csrf
                        <div class="mb-3">
                            <label style="font-size:0.72rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--primary);display:block;margin-bottom:0.35rem;">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" style="border-radius:8px;border:1.5px solid rgba(0,0,0,0.1);" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="mb-3">
                            <label style="font-size:0.72rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--primary);display:block;margin-bottom:0.35rem;">Email</label>
                            <input type="email" name="email" class="form-control" style="border-radius:8px;border:1.5px solid rgba(0,0,0,0.1);" placeholder="Contoh: budi@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label style="font-size:0.72rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--primary);display:block;margin-bottom:0.35rem;">No. Telepon</label>
                            <input type="tel" name="telpon" class="form-control" style="border-radius:8px;border:1.5px solid rgba(0,0,0,0.1);" placeholder="Contoh: 08123456789" required>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="button" class="btn btn-outline-secondary" style="border-radius:8px;" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn" style="background:var(--accent);color:var(--primary);font-weight:700;border-radius:8px;letter-spacing:1px;">
                                <i class="bi bi-check-lg me-1"></i> Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection