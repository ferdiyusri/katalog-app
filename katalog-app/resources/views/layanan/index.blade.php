@extends('layouts.frontend')

@section('title', 'Layanan')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #0d0d1f 0%, #1a1a2e 45%, #0f3460 100%);
        padding: 3.5rem 0 4.5rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        width: 600px; height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,169,110,0.07) 0%, transparent 70%);
        top: -200px; right: -100px;
        pointer-events: none;
    }
    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 60px;
        background: var(--light);
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 0.6rem;
        background: rgba(201,169,110,0.1); border: 1px solid rgba(201,169,110,0.25);
        border-radius: 30px; padding: 0.35rem 1rem;
        font-size: 0.72rem; font-weight: 700; letter-spacing: 3px;
        text-transform: uppercase; color: var(--accent); margin-bottom: 1.25rem;
    }
    .page-header-badge i { font-size: 0.7rem; }

    .section-label {
        display: inline-flex; align-items: center; gap: 0.75rem;
        font-size: 0.72rem; font-weight: 700; letter-spacing: 4px;
        text-transform: uppercase; color: var(--accent); margin-bottom: 0.6rem;
    }
    .section-label::before { content: ''; width: 24px; height: 2px; background: var(--accent); border-radius: 2px; }

    .section-services-intro { padding: 5rem 0 2.5rem; }

    .service-overview-card {
        background: var(--white); border-radius: 14px; border: 1px solid rgba(0,0,0,0.07);
        padding: 2rem 1.75rem 1.75rem; height: 100%; position: relative; overflow: hidden;
        transition: all 0.35s ease; box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .service-overview-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: var(--accent); transform: scaleX(0); transform-origin: left; transition: transform 0.35s ease;
    }
    .service-overview-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); border-color: rgba(201,169,110,0.3); }
    .service-overview-card:hover::before { transform: scaleX(1); }
    .service-overview-icon { width: 54px; height: 54px; background: rgba(201,169,110,0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--accent); margin-bottom: 1.25rem; }
    .service-overview-letter { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.65rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: var(--accent); background: rgba(201,169,110,0.12); border-radius: 20px; padding: 0.2rem 0.65rem; margin-bottom: 0.7rem; }
    .service-overview-title { font-family: 'Playfair Display', serif; font-size: 1.08rem; font-weight: 700; color: var(--primary); margin-bottom: 0.6rem; line-height: 1.3; }
    .service-overview-desc { font-size: 0.84rem; color: var(--gray); line-height: 1.7; }

    .section-services { padding: 1rem 0 5rem; }
    .service-row { padding: 4.5rem 0; border-top: 1px solid rgba(0,0,0,0.07); }
    .service-visual {
        background: var(--primary); border-radius: 16px; aspect-ratio: 4 / 3;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .service-visual::before {
        content: ''; position: absolute; inset: 0;
        background:
            radial-gradient(ellipse at 25% 25%, rgba(201,169,110,0.15) 0%, transparent 55%),
            radial-gradient(ellipse at 80% 80%, rgba(15,52,96,0.6) 0%, transparent 50%);
    }
    .service-visual::after {
        content: ''; position: absolute; inset: 0;
        background-image: repeating-linear-gradient(45deg, transparent, transparent 30px, rgba(255,255,255,0.012) 30px, rgba(255,255,255,0.012) 31px);
    }
    .service-visual-icon { font-size: 3.5rem; color: var(--accent); position: relative; z-index: 2; filter: drop-shadow(0 4px 20px rgba(201,169,110,0.35)); }
    .service-visual-ring { position: absolute; width: 140px; height: 140px; border: 1px solid rgba(201,169,110,0.15); border-radius: 50%; z-index: 1; }
    .service-visual-ring-2 { position: absolute; width: 220px; height: 220px; border: 1px solid rgba(201,169,110,0.07); border-radius: 50%; z-index: 1; }
    .service-visual-num { font-family: 'Playfair Display', serif; font-size: 8rem; font-weight: 700; color: rgba(201,169,110,0.05); position: absolute; bottom: -20px; right: 8px; line-height: 1; z-index: 1; }
    .service-visual-label { position: absolute; top: 1.25rem; left: 1.25rem; font-size: 0.6rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; padding: 0.3rem 0.8rem; z-index: 2; }
    .service-content { padding: 0.5rem 0 0.5rem 1rem; }
    .service-tag { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.65rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--accent); background: rgba(201,169,110,0.12); border-radius: 20px; padding: 0.25rem 0.75rem; margin-bottom: 0.75rem; }
    .service-heading { font-family: 'Playfair Display', serif; font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: var(--primary); margin-bottom: 0.4rem; line-height: 1.2; }
    .service-focus { font-size: 0.85rem; color: rgba(201,169,110,0.9); font-style: italic; margin-bottom: 1.1rem; }
    .service-desc { color: #5a5a6a; font-size: 0.92rem; line-height: 1.85; margin-bottom: 1.75rem; }
    .service-scope-title { font-size: 0.65rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: var(--primary); margin-bottom: 0.85rem; padding-bottom: 0.6rem; border-bottom: 1px solid rgba(0,0,0,0.07); }
    .service-list { list-style: none; padding: 0; margin: 0 0 1.75rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.55rem 1rem; }
    .service-list.single-col { grid-template-columns: 1fr; }
    .service-list li { display: flex; align-items: flex-start; gap: 0.65rem; font-size: 0.875rem; color: #444; line-height: 1.5; padding: 0.5rem 0.75rem; background: var(--white); border-radius: 8px; border: 1px solid rgba(0,0,0,0.07); }
    .service-list li i { color: var(--accent); font-size: 0.72rem; margin-top: 0.28rem; flex-shrink: 0; }
    .btn-konsultasi { display: inline-flex; align-items: center; gap: 0.6rem; background: var(--accent); color: var(--primary); font-weight: 700; font-size: 0.8rem; letter-spacing: 1.5px; text-transform: uppercase; padding: 0.8rem 1.75rem; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
    .btn-konsultasi:hover { background: var(--primary); color: var(--white); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }

    .section-process { background: var(--primary); padding: 5.5rem 0; position: relative; overflow: hidden; }
    .section-process::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 80% 50%, rgba(15,52,96,0.5) 0%, transparent 60%); }
    .process-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0; position: relative; }
    .process-grid::before { content: ''; position: absolute; top: 28px; left: 14%; right: 14%; height: 1px; background: linear-gradient(to right, transparent, rgba(201,169,110,0.25), rgba(201,169,110,0.25), transparent); }
    .process-item { text-align: center; padding: 0 1.5rem; position: relative; z-index: 1; }
    .process-num { width: 56px; height: 56px; background: rgba(201,169,110,0.08); border: 1px solid rgba(201,169,110,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: var(--accent); }
    .process-icon { font-size: 1.25rem; color: var(--accent); margin-bottom: 0.6rem; display: block; }
    .process-title { font-family: 'Playfair Display', serif; font-size: 0.95rem; font-weight: 700; color: var(--white); margin-bottom: 0.5rem; }
    .process-desc { font-size: 0.8rem; color: rgba(255,255,255,0.35); line-height: 1.65; }

    .section-cta { background: var(--accent); padding: 5rem 0; text-align: center; position: relative; overflow: hidden; }
    .section-cta::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 50% 0%, rgba(255,255,255,0.1) 0%, transparent 60%); }
    .cta-title { font-family: 'Playfair Display', serif; font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; color: var(--primary); margin-bottom: 0.75rem; position: relative; }
    .cta-desc { color: rgba(26,26,46,0.6); font-size: 0.9rem; max-width: 460px; margin: 0 auto 2rem; line-height: 1.8; position: relative; }
    .btn-cta-dark { display: inline-flex; align-items: center; gap: 0.6rem; background: var(--primary); color: var(--white); font-weight: 700; font-size: 0.82rem; letter-spacing: 2px; text-transform: uppercase; padding: 0.9rem 2.5rem; border: none; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; position: relative; }
    .btn-cta-dark:hover { background: var(--dark); color: var(--white); transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.25); }

    @media (max-width: 991px) {
        .service-list { grid-template-columns: 1fr; }
        .service-content { padding-left: 0; }
        .process-grid { grid-template-columns: repeat(2, 1fr); gap: 2.5rem 0; }
        .process-grid::before { display: none; }
    }
    @media (max-width: 768px) {
        .page-header { padding: 2.5rem 0 3.5rem; }
        .service-row { padding: 3rem 0; }
        .service-visual { aspect-ratio: 16 / 7; margin-bottom: 1.5rem; border-radius: 12px; }
        .section-services-intro { padding: 3.5rem 0 1.5rem; }
    }
    @media (max-width: 480px) {
        .process-grid { grid-template-columns: 1fr 1fr; gap: 1.5rem 0; }
        .page-header::after { display: none; }
    }
</style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="page-header-badge">
                <i class="bi bi-grid-3x3-gap-fill"></i> 4 Bidang Layanan
            </div>
            <h1 style="font-family:'Playfair Display',serif; color:#fff; font-size:clamp(1.9rem,5vw,3rem); font-weight:700; line-height:1.2; max-width: 640px;">
                Solusi Terpadu dari<br><span style="color:var(--accent);">HIKO STUDIO</span>
            </h1>
            <p style="color:rgba(255,255,255,0.5); margin-top:1rem; max-width:540px; font-size:0.95rem; line-height:1.85;">
                Dari perencanaan arsitektur, desain interior, pembangunan, hingga furnitur custom — kami hadir sebagai mitra terpercaya untuk mewujudkan ruang yang estetis, fungsional, dan bernilai tinggi.
            </p>
        </div>
    </section>

    <section class="section-services-intro">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label" style="justify-content: center;">Apa yang Kami Kerjakan</div>
                <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.5rem,2.5vw,2rem); font-weight:700; color:var(--primary);">
                    Empat Bidang Layanan Kami
                </h2>
                <p style="color:var(--gray); font-size:0.88rem; margin-top:0.5rem; max-width:440px; margin-left:auto; margin-right:auto; line-height:1.7;">
                    Setiap layanan dirancang untuk memenuhi kebutuhan spesifik proyek Anda.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="service-overview-card">
                        <div class="service-overview-icon"><i class="bi bi-building-gear"></i></div>
                        <div class="service-overview-letter">A — Arsitektur</div>
                        <div class="service-overview-title">Architecture</div>
                        <p class="service-overview-desc">Perencanaan arsitektur menyeluruh mulai dari desain bangunan 2D/3D, gambar kerja teknis, hingga estimasi biaya.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-overview-card">
                        <div class="service-overview-icon"><i class="bi bi-palette2"></i></div>
                        <div class="service-overview-letter">B — Interior</div>
                        <div class="service-overview-title">Interior Design</div>
                        <p class="service-overview-desc">Konsep desain interior dengan visualisasi 3D, pemilihan material, dan styling estetika ruang sesuai karakter Anda.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-overview-card">
                        <div class="service-overview-icon"><i class="bi bi-hammer"></i></div>
                        <div class="service-overview-letter">C — Build</div>
                        <div class="service-overview-title">Design dan Build</div>
                        <p class="service-overview-desc">Pembangunan dari nol, renovasi total maupun parsial, dengan project management dan pengawasan kualitas penuh.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-overview-card">
                        <div class="service-overview-icon"><i class="bi bi-box-seam"></i></div>
                        <div class="service-overview-letter">D — Custom</div>
                        <div class="service-overview-title">Custom Interior</div>
                        <p class="service-overview-desc">Furniture built-in, kitchen set, wardrobe, dan berbagai produk custom lainnya sesuai dimensi dan kebutuhan ruang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-services">
        <div class="container">

            <!-- A. Arsitektur -->
            <div class="row align-items-center g-5 service-row">
                <div class="col-lg-5">
                    @if($siteImages['layanan_arsitektur'])
                    <div class="service-visual w-100" style="background-image:url('{{ Storage::url($siteImages['layanan_arsitektur']) }}'); background-size:cover; background-position:center;">
                    </div>
                    @else
                    <div class="service-visual w-100">
                        <div class="service-visual-ring"></div>
                        <div class="service-visual-ring-2"></div>
                        <i class="bi bi-building-gear service-visual-icon"></i>
                        <span class="service-visual-num">A</span>
                    </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="service-content">
                        <span class="service-tag">Layanan A — Arsitektur</span>
                        <h2 class="service-heading">Architecture</h2>
                        <p class="service-focus">Menciptakan harmoni antara konsep, identitas, dan lingkungan.</p>
                        <p class="service-desc">
                            Kami merancang konsep arsitektur yang kuat dan kontekstual — mulai dari perencanaan awal hingga gambar teknis siap bangun. Setiap detail direncanakan dengan presisi untuk menghasilkan bangunan yang estetis dan fungsional.
                        </p>
                        <div class="service-scope-title">Ruang Lingkup Pekerjaan</div>
                        <ul class="service-list">
                            <li><i class="bi bi-check-circle-fill"></i> Desain bangunan 2D dan 3D</li>
                            <li><i class="bi bi-check-circle-fill"></i> Perencanaan tapak (site planning)</li>
                            <li><i class="bi bi-check-circle-fill"></i> Desain tampak &amp; rangka bangunan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Gambar kerja teknis lengkap</li>
                            <li><i class="bi bi-check-circle-fill"></i> Perencanaan pembangunan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Estimasi biaya (cost planning)</li>
                        </ul>
                        <a href="{{ route('kontak.index') }}" class="btn-konsultasi">
                            <i class="bi bi-envelope"></i> Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>

            <!-- B. Interior Design -->
            <div class="row align-items-center g-5 service-row flex-lg-row-reverse">
                <div class="col-lg-5">
                    @if($siteImages['layanan_interior'])
                    <div class="service-visual w-100" style="background-image:url('{{ Storage::url($siteImages['layanan_interior']) }}'); background-size:cover; background-position:center;">
                        <span class="service-visual-label">Interior Design</span>
                    </div>
                    @else
                    <div class="service-visual w-100">
                        <div class="service-visual-ring"></div>
                        <div class="service-visual-ring-2"></div>
                        <i class="bi bi-palette2 service-visual-icon"></i>
                        <span class="service-visual-num">B</span>
                        <span class="service-visual-label">Interior Design</span>
                    </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="service-content">
                        <span class="service-tag">Layanan B — Interior</span>
                        <h2 class="service-heading">Interior Design</h2>
                        <p class="service-focus">Ruang yang nyaman, estetis, dan mencerminkan karakter penghuninya.</p>
                        <p class="service-desc">
                            Tim desainer kami merancang interior yang memadukan fungsi dan estetika. Dari konsep awal hingga pemilihan material, setiap keputusan desain dibuat dengan mempertimbangkan kebutuhan dan selera Anda.
                        </p>
                        <div class="service-scope-title">Ruang Lingkup Pekerjaan</div>
                        <ul class="service-list">
                            <li><i class="bi bi-check-circle-fill"></i> Konsep desain interior</li>
                            <li><i class="bi bi-check-circle-fill"></i> Visualisasi 3D rendering</li>
                            <li><i class="bi bi-check-circle-fill"></i> Pemilihan material &amp; finishing</li>
                            <li><i class="bi bi-check-circle-fill"></i> Styling dan estetika ruang</li>
                            <li><i class="bi bi-check-circle-fill"></i> Hunian, apartemen, kantor, hotel</li>
                            <li><i class="bi bi-check-circle-fill"></i> Supervisi pelaksanaan lapangan</li>
                        </ul>
                        <a href="{{ route('kontak.index') }}" class="btn-konsultasi">
                            <i class="bi bi-envelope"></i> Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>

            <!-- C. Design & Build -->
            <div class="row align-items-center g-5 service-row">
                <div class="col-lg-5">
                    @if($siteImages['layanan_designbuild'])
                    <div class="service-visual w-100" style="background-image:url('{{ Storage::url($siteImages['layanan_designbuild']) }}'); background-size:cover; background-position:center;">
                        <span class="service-visual-label">Design dan Build</span>
                    </div>
                    @else
                    <div class="service-visual w-100">
                        <div class="service-visual-ring"></div>
                        <div class="service-visual-ring-2"></div>
                        <i class="bi bi-hammer service-visual-icon"></i>
                        <span class="service-visual-num">C</span>
                        <span class="service-visual-label">Design dan Build</span>
                    </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="service-content">
                        <span class="service-tag">Layanan C — Build</span>
                        <h2 class="service-heading">Design dan Build</h2>
                        <p class="service-focus">Dari ide menjadi bangunan nyata — tepat waktu, tepat anggaran.</p>
                        <p class="service-desc">
                            Layanan pembangunan dan renovasi menyeluruh dengan sistem design and build terintegrasi. Kami mengelola seluruh proses mulai dari desain, pengerjaan, hingga serah terima dengan standar kualitas yang ketat.
                        </p>
                        <div class="service-scope-title">Ruang Lingkup Pekerjaan</div>
                        <ul class="service-list">
                            <li><i class="bi bi-check-circle-fill"></i> Pembangunan dari nol</li>
                            <li><i class="bi bi-check-circle-fill"></i> Renovasi total maupun parsial</li>
                            <li><i class="bi bi-check-circle-fill"></i> Project management terstruktur</li>
                            <li><i class="bi bi-check-circle-fill"></i> Pengawasan kualitas &amp; timeline</li>
                            <li><i class="bi bi-check-circle-fill"></i> Hunian, komersial, café, retail</li>
                            <li><i class="bi bi-check-circle-fill"></i> Infrastruktur ringan dan paving</li>
                        </ul>
                        <a href="{{ route('kontak.index') }}" class="btn-konsultasi">
                            <i class="bi bi-envelope"></i> Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>

            <!-- D. Custom Interior -->
            <div class="row align-items-center g-5 service-row flex-lg-row-reverse">
                <div class="col-lg-5">
                    @if($siteImages['layanan_custom'])
                    <div class="service-visual w-100" style="background-image:url('{{ Storage::url($siteImages['layanan_custom']) }}'); background-size:cover; background-position:center;">
                        <span class="service-visual-label">Custom Interior</span>
                    </div>
                    @else
                    <div class="service-visual w-100">
                        <div class="service-visual-ring"></div>
                        <div class="service-visual-ring-2"></div>
                        <i class="bi bi-box-seam service-visual-icon"></i>
                        <span class="service-visual-num">D</span>
                        <span class="service-visual-label">Custom Interior</span>
                    </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="service-content">
                        <span class="service-tag">Layanan D — Custom</span>
                        <h2 class="service-heading">Custom Interior</h2>
                        <p class="service-focus">Furniture yang dirancang pas untuk ruang Anda, bukan sebaliknya.</p>
                        <p class="service-desc">
                            Setiap produk custom yang kami buat dirancang khusus sesuai dimensi, gaya, dan kebutuhan ruang Anda. Dikerjakan oleh pengrajin terlatih dengan material pilihan dan perhatian penuh pada detail.
                        </p>
                        <div class="service-scope-title">Ruang Lingkup Pekerjaan</div>
                        <ul class="service-list single-col">
                            <li><i class="bi bi-check-circle-fill"></i> Furniture built-in (lemari, rak, meja, partisi)</li>
                            <li><i class="bi bi-check-circle-fill"></i> Kitchen set — modular maupun custom penuh</li>
                            <li><i class="bi bi-check-circle-fill"></i> Wardrobe dan storage custom</li>
                            <li><i class="bi bi-check-circle-fill"></i> Produk custom lainnya sesuai permintaan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Beragam pilihan material dan finishing premium</li>
                        </ul>
                        <a href="{{ route('kontak.index') }}" class="btn-konsultasi">
                            <i class="bi bi-envelope"></i> Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="section-process">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="text-center mb-5">
                <div class="section-label" style="justify-content: center;">Proses Kerja</div>
                <h2 style="font-family:'Playfair Display',serif; color:var(--white); font-size:clamp(1.6rem,3vw,2.2rem); font-weight:700;">
                    Bagaimana <span style="color:var(--accent);">Kami Bekerja</span>
                </h2>
                <p style="color:rgba(255,255,255,0.38); font-size:0.88rem; margin-top:0.5rem; max-width:440px; margin-left:auto; margin-right:auto; line-height:1.7;">
                    Proses terstruktur dari konsultasi awal hingga serah terima — transparan dan berorientasi hasil.
                </p>
            </div>
            <div class="process-grid">
                <div class="process-item">
                    <div class="process-num">01</div>
                    <i class="bi bi-chat-dots process-icon"></i>
                    <div class="process-title">Konsultasi Awal</div>
                    <p class="process-desc">Kami mendengarkan kebutuhan, selera, dan anggaran Anda untuk menentukan arah proyek.</p>
                </div>
                <div class="process-item">
                    <div class="process-num">02</div>
                    <i class="bi bi-pencil-square process-icon"></i>
                    <div class="process-title">Perancangan</div>
                    <p class="process-desc">Penyusunan konsep desain, visualisasi 3D, dan rencana teknis yang terperinci.</p>
                </div>
                <div class="process-item">
                    <div class="process-num">03</div>
                    <i class="bi bi-hammer process-icon"></i>
                    <div class="process-title">Pelaksanaan</div>
                    <p class="process-desc">Proyek dijalankan oleh tim terlatih dengan pengawasan berkala dan laporan progres rutin.</p>
                </div>
                <div class="process-item">
                    <div class="process-num">04</div>
                    <i class="bi bi-patch-check process-icon"></i>
                    <div class="process-title">Serah Terima</div>
                    <p class="process-desc">Hasil akhir ditinjau bersama Anda dan diserahterimakan disertai garansi kualitas.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-cta">
        <div class="container" style="position: relative; z-index: 1;">
            <h2 class="cta-title">Siap Mulai Proyek Anda?</h2>
            <p class="cta-desc">Konsultasikan kebutuhan Anda kepada tim kami secara gratis. Kami akan membantu menemukan solusi terbaik sesuai budget dan gaya Anda.</p>
            <a href="{{ route('kontak.index') }}" class="btn-cta-dark">
                <i class="bi bi-envelope"></i> Kirim Pesan Sekarang
            </a>
        </div>
    </section>
@endsection
