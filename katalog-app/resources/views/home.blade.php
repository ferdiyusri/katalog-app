@extends('layouts.frontend')

@section('title', 'Beranda')
@section('navbar-class', 'fixed-top')

@section('styles')
<style>
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary) 0%, #16213e 50%, #0f3460 100%);
    overflow: hidden;
}
.hero-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background:
        radial-gradient(ellipse at 20% 50%, rgba(201,169,110,0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 20%, rgba(201,169,110,0.05) 0%, transparent 50%);
    pointer-events: none;
}
.hero-geometric { position: absolute; border: 1px solid rgba(201,169,110,0.1); pointer-events: none; }
.hero-geometric-1 { width: 400px; height: 400px; top: -100px; right: -100px; transform: rotate(45deg); }
.hero-geometric-2 { width: 250px; height: 250px; bottom: -50px; left: -50px; transform: rotate(30deg); border-color: rgba(201,169,110,0.07); }
.hero-geometric-3 { width: 150px; height: 150px; top: 30%; right: 15%; transform: rotate(60deg); border-color: rgba(201,169,110,0.12); }
.hero-label {
    display: inline-block; font-size: 0.75rem; font-weight: 600;
    letter-spacing: 4px; text-transform: uppercase; color: var(--accent);
    margin-bottom: 1.5rem; position: relative; padding-left: 50px;
}
.hero-label::before { content: ''; position: absolute; left: 0; top: 50%; width: 35px; height: 1px; background: var(--accent); }
.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.8rem, 6vw, 4.5rem);
    font-weight: 700; color: var(--white); line-height: 1.15; margin-bottom: 1.5rem;
}
.hero-title .highlight { color: var(--accent); font-style: italic; }
.hero-desc { font-size: 1.1rem; color: rgba(255,255,255,0.6); line-height: 1.8; max-width: 500px; margin-bottom: 2.5rem; font-weight: 300; }
.hero-services { display: flex; flex-direction: column; gap: 0.65rem; margin-bottom: 2.5rem; }
.hero-service-item { display: flex; align-items: center; gap: 0.85rem; color: rgba(255,255,255,0.75); font-size: 0.95rem; font-weight: 400; letter-spacing: 0.3px; }
.hero-service-icon { width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(201,169,110,0.4); border-radius: 6px; color: var(--accent); font-size: 0.85rem; flex-shrink: 0; }
.hero-stats { margin-top: 2.5rem; display: flex; gap: 3rem; }
.hero-stat { text-align: left; }
.hero-stat-number { font-family: 'Playfair Display', serif; font-size: 2.2rem; font-weight: 700; color: var(--accent); display: block; }
.hero-stat-label { font-size: 0.8rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 0.25rem; }
.hero-image-wrapper { position: relative; height: 550px; }

.section-categories { padding: 6rem 0; background: var(--white); }
.section-label {
    font-size: 0.75rem; font-weight: 600; letter-spacing: 4px; text-transform: uppercase;
    color: var(--accent); margin-bottom: 1rem; display: inline-block; position: relative; padding-left: 50px;
}
.section-label::before { content: ''; position: absolute; left: 0; top: 50%; width: 35px; height: 1px; background: var(--accent); }
.text-center .section-label { padding-left: 0; }
.text-center .section-label::before { display: none; }
.section-title { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 700; color: var(--primary); margin-bottom: 1rem; }
.section-subtitle { font-size: 1.05rem; color: var(--gray); max-width: 550px; line-height: 1.7; font-weight: 300; }
.category-card { position: relative; overflow: hidden; height: 420px; border-radius: 14px; cursor: pointer; transition: all 0.5s ease; }
.category-card:hover { transform: translateY(-8px); box-shadow: 0 25px 60px rgba(0,0,0,0.15); }
.category-card-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 2.5rem; background: linear-gradient(transparent, rgba(15,15,26,0.9)); transition: all 0.4s ease; }
.category-card:hover .category-card-overlay { background: linear-gradient(transparent, rgba(15,15,26,0.95)); }
.category-card-title { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--white); margin-bottom: 0.5rem; }
.category-card-desc { font-size: 0.9rem; color: rgba(255,255,255,0.6); margin-bottom: 1rem; font-weight: 300; }
.category-card-link { display: inline-flex; align-items: center; gap: 0.5rem; color: var(--accent); font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; transition: gap 0.3s ease; }
.category-card:hover .category-card-link { gap: 1rem; }

.section-features { padding: 6rem 0; background: var(--primary); position: relative; overflow: hidden; }
.section-features::before { content: ''; position: absolute; top: 0; right: 0; width: 400px; height: 400px; border: 1px solid rgba(201,169,110,0.08); transform: rotate(45deg) translate(100px, -100px); }
.feature-card { text-align: center; padding: 2.5rem 1.5rem; border-radius: 14px; transition: all 0.4s ease; border: 1px solid rgba(255,255,255,0.05); }
.feature-card:hover { background: rgba(255,255,255,0.04); border-color: rgba(201,169,110,0.2); transform: translateY(-4px); }
.feature-icon { width: 66px; height: 66px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; border: 1.5px solid rgba(201,169,110,0.4); border-radius: 14px; color: var(--accent); font-size: 1.6rem; transition: all 0.4s ease; }
.feature-card:hover .feature-icon { background: var(--accent); border-color: var(--accent); color: var(--primary); }
.feature-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 600; color: var(--white); margin-bottom: 0.75rem; }
.feature-desc { font-size: 0.88rem; color: rgba(255,255,255,0.5); line-height: 1.7; font-weight: 300; }

.fade-up { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
.fade-up.visible { opacity: 1; transform: translateY(0); }

@media (max-width: 768px) {
    .hero-section { min-height: auto; padding: 7rem 0 4rem; }
    .hero-title { font-size: clamp(1.7rem, 8vw, 2.2rem); }
    .hero-desc { font-size: 0.92rem; max-width: 100%; }
    .hero-stats { gap: 1.5rem; margin-top: 2rem; flex-wrap: wrap; }
    .hero-stat-number { font-size: 1.5rem; }
    .hero-geometric-1, .hero-geometric-2, .hero-geometric-3 { display: none; }
    .category-card { height: 260px; }
    .category-card-title { font-size: 1.3rem; }
    .category-card-overlay { padding: 1.5rem; }
    .category-card-desc { font-size: 0.82rem; }
    .section-categories, .section-features { padding: 3rem 0; }
    .section-title { font-size: clamp(1.6rem, 6vw, 2.2rem); }
    .section-subtitle { font-size: 0.92rem; }
    .feature-card { padding: 1.75rem 1rem; }
}
@media (max-width: 480px) {
    .hero-section { padding: 6rem 0 3rem; }
    .hero-title { font-size: 1.7rem; }
    .hero-label { font-size: 0.65rem; padding-left: 38px; }
    .hero-stats { gap: 1rem; }
    .hero-stat-number { font-size: 1.2rem; }
    .category-card { height: 200px; }
    .section-categories, .section-features { padding: 2.5rem 0; }
}
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-section">
    <div class="hero-geometric hero-geometric-1"></div>
    <div class="hero-geometric hero-geometric-2"></div>
    <div class="hero-geometric hero-geometric-3"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">Wujudkan Ruang <br><span class="highlight">Impian</span> Anda</h1>
                <p class="hero-desc">Kami menyediakan layanan desain interior dan pembangunan secara profesional dan terukur menghadirkan ruang yang estetis, fungsional, serta berorientasi pada kualitas dan nilai jangka panjang.</p>

                <div class="hero-services">
                    <div class="hero-service-item">
                        <span class="hero-service-icon"><i class="bi bi-pencil-square"></i></span>
                        <span>Perencanaan &amp; Desain</span>
                    </div>
                    <div class="hero-service-item">
                        <span class="hero-service-icon"><i class="bi bi-hammer"></i></span>
                        <span>Pembangunan &amp; Renovasi</span>
                    </div>
                    <div class="hero-service-item">
                        <span class="hero-service-icon"><i class="bi bi-house-heart"></i></span>
                        <span>Interior &amp; Custom Furniture</span>
                    </div>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat"><span class="hero-stat-number">{{ $totalProducts }}</span><span class="hero-stat-label">Produk</span></div>
                    <div class="hero-stat"><span class="hero-stat-number">{{ $totalCategories }}</span><span class="hero-stat-label">Kategori</span></div>
                    <div class="hero-stat"><span class="hero-stat-number">100%</span><span class="hero-stat-label">Terpercaya</span></div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
                @if($siteImages['hero'])
                <div class="hero-image-wrapper" style="background-image:url('{{ Storage::url($siteImages['hero']) }}'); background-size:cover; background-position:center; border-radius:12px; border:1px solid rgba(201,169,110,0.15);"></div>
                @else
                <div class="hero-image-wrapper" style="background: linear-gradient(135deg, rgba(201,169,110,0.1), rgba(201,169,110,0.03)); border: 1px solid rgba(201,169,110,0.15); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:1rem;">
                    <i class="bi bi-building" style="font-size: 4rem; color: var(--accent); opacity:0.5;"></i>
                    <span style="color: rgba(255,255,255,0.3); font-size:0.85rem; letter-spacing:2px; text-transform:uppercase;">Gambar Hero</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section class="section-categories">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Pilih Kategori Anda</h2>
            <p class="section-subtitle mx-auto">Kami menyediakan produk dan layanan di bidang Arsitektur, Desain, dan Interior untuk mewujudkan ruang impian Anda.</p>
        </div>
        <div class="row g-4 fade-up">
            <div class="col-md-6">
                <a href="{{ route('products.interior') }}" style="text-decoration:none;">
                    <div class="category-card"
                            @if($siteImages['category_interior'])
                            style="background-image:url('{{ Storage::url($siteImages['category_interior']) }}'); background-size:cover; background-position:center;"
                            @else
                            style="background: linear-gradient(135deg, #2d2d44, #1a1a2e);"
                            @endif>
                        @unless($siteImages['category_interior'])
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-lamp" style="font-size:5rem;color:var(--accent);opacity:0.2;"></i>
                        </div>
                        @endunless
                        <div class="category-card-overlay">
                            <h3 class="category-card-title">Interior</h3>
                            <p class="category-card-desc">Furnitur, dekorasi, pencahayaan, dan semua kebutuhan desain interior.</p>
                            <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('products.builddesain') }}" style="text-decoration:none;">
                    <div class="category-card"
                            @if($siteImages['category_builddesain'])
                            style="background-image:url('{{ Storage::url($siteImages['category_builddesain']) }}'); background-size:cover; background-position:center;"
                            @else
                            style="background: linear-gradient(135deg, #3d3527, #2a2318);"
                            @endif>
                        @unless($siteImages['category_builddesain'])
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-buildings" style="font-size:5rem;color:var(--accent);opacity:0.2;"></i>
                        </div>
                        @endunless
                        <div class="category-card-overlay">
                            <h3 class="category-card-title">Build dan Desain</h3>
                            <p class="category-card-desc">Material bangunan, struktur arsitektur, dan kebutuhan konstruksi berkualitas tinggi.</p>
                            <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="section-features">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title" style="color: var(--white);">Komitmen Kami untuk Setiap Proyek</h2>
        </div>
        <div class="row g-4 fade-up">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-layers"></i></div>
                    <h4 class="feature-title">Design dan Build Terintegrasi</h4>
                    <p class="feature-desc">Solusi menyeluruh dari konsep hingga realisasi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-people"></i></div>
                    <h4 class="feature-title">Tim Profesional</h4>
                    <p class="feature-desc">Didukung oleh tim berpengalaman di bidang desain dan konstruksi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-wallet2"></i></div>
                    <h4 class="feature-title">Transparansi Biaya</h4>
                    <p class="feature-desc">Perencanaan anggaran yang jelas dan terkontrol.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-gem"></i></div>
                    <h4 class="feature-title">Perhatian pada Detail</h4>
                    <p class="feature-desc">Mengutamakan kualitas, fungsi, dan estetika dalam setiap proyek.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
window.addEventListener('scroll', function() {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
});
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), index * 100);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
@endsection
