@extends('layouts.frontend')
@section('title', 'Tentang')

@section('styles')
<style>
    /* ===== PAGE HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #0d0d1f 0%, #1a1a2e 45%, #0f3460 100%);
        padding: 3.5rem 0 4.5rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,169,110,0.07) 0%, transparent 70%);
        top: -150px;
        right: -80px;
        pointer-events: none;
    }
    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: var(--light);
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .page-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: rgba(201,169,110,0.1);
        border: 1px solid rgba(201,169,110,0.25);
        border-radius: 30px;
        padding: 0.35rem 1rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 1.25rem;
    }

    /* ===== SECTION LABEL ===== */
    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 0.6rem;
    }
    .section-label::before { content: ''; width: 24px; height: 2px; background: var(--accent); border-radius: 2px; }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.8rem, 3vw, 2.4rem);
        font-weight: 700;
        color: var(--primary);
        line-height: 1.2;
    }

    /* ===== INTRO ===== */
    .section-about-intro {
        padding: 5rem 0 4rem;
        background: var(--white);
    }
    .about-tagline {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        color: var(--primary);
        line-height: 1.4;
        margin-bottom: 1.25rem;
    }
    .about-tagline span { color: var(--accent); }
    .accent-bar {
        width: 40px;
        height: 3px;
        background: var(--accent);
        border-radius: 2px;
        margin-bottom: 1.5rem;
    }
    .about-desc {
        color: var(--gray);
        font-size: 0.95rem;
        line-height: 1.85;
        font-weight: 300;
    }
    .about-meaning-card {
        padding: 1rem 1.25rem;
        border-left: 3px solid var(--accent);
        background: var(--accent-light);
        border-radius: 0 8px 8px 0;
        margin-bottom: 0.75rem;
    }
    .about-meaning-card strong { color: var(--primary); }
    .about-meaning-card span { font-size: 0.88rem; color: var(--gray); display: block; margin-top: 0.2rem; }

    .about-logo-box {
        background: var(--primary);
        border-radius: 16px;
        padding: 4rem 3rem;
        height: 100%;
        min-height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .about-logo-box::before {
        content: '光';
        position: absolute;
        font-family: 'Playfair Display', serif;
        font-size: 16rem;
        color: rgba(201,169,110,0.03);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        line-height: 1;
    }
    .about-logo-box::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        border: 1px solid rgba(201,169,110,0.08);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* ===== VISI MISI ===== */
    .section-visi {
        padding: 5rem 0;
        background: var(--light);
    }
    .visi-card {
        background: var(--white);
        padding: 2.5rem;
        border-radius: 14px;
        border: 1px solid var(--border);
        border-top: 3px solid var(--accent);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .visi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 48px rgba(0,0,0,0.08);
    }
    .visi-icon {
        width: 52px;
        height: 52px;
        background: var(--accent-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    .visi-icon i { font-size: 1.4rem; color: var(--accent); }
    .visi-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }
    .visi-text { color: var(--gray); font-size: 0.93rem; line-height: 1.8; font-weight: 300; }
    .misi-list { list-style: none; padding: 0; margin: 0; }
    .misi-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        color: var(--gray);
        font-size: 0.93rem;
        line-height: 1.7;
        font-weight: 300;
        margin-bottom: 0.85rem;
        padding: 0.6rem 0.75rem;
        background: var(--light);
        border-radius: 8px;
    }
    .misi-list li i { color: var(--accent); font-size: 0.85rem; margin-top: 0.25rem; flex-shrink: 0; }

    /* ===== NILAI ===== */
    .section-nilai {
        padding: 5rem 0;
        background: var(--white);
    }
    .nilai-item {
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        padding: 1.75rem;
        border-radius: 14px;
        border: 1px solid var(--border);
        background: var(--white);
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .nilai-item:hover {
        border-color: rgba(201,169,110,0.35);
        box-shadow: 0 10px 36px rgba(0,0,0,0.07);
        transform: translateY(-3px);
    }
    .nilai-num {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: rgba(201,169,110,0.2);
        line-height: 1;
        flex-shrink: 0;
        width: 44px;
    }
    .nilai-title {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--primary);
        margin-bottom: 0.4rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .nilai-desc { color: var(--gray); font-size: 0.88rem; line-height: 1.7; font-weight: 300; }

    /* ===== TEAM ===== */
    .section-team {
        padding: 5rem 0;
        background: var(--light);
    }
    .team-card {
        background: var(--white);
        border-radius: 14px;
        border: 1px solid var(--border);
        padding: 2rem 1.5rem 1.75rem;
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        border-color: rgba(201,169,110,0.3);
    }
    .team-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, #16213e 100%);
        border: 3px solid rgba(201,169,110,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        margin: 0 auto 1.25rem;
    }
    .team-avatar-icon { font-size: 2.5rem; color: var(--accent); opacity: 0.2; }
    .team-avatar-initials {
        position: absolute;
        font-family: 'Playfair Display', serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--accent);
        letter-spacing: 2px;
        z-index: 1;
    }
    .team-body { padding: 0 1.4rem 1.5rem; text-align: center; }
    .team-name {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }
    .team-role {
        display: inline-flex;
        align-items: center;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--accent);
        background: var(--accent-light);
        border-radius: 20px;
        padding: 0.2rem 0.65rem;
    }

    /* ===== CTA ===== */
    .section-cta-about {
        background: var(--primary);
        padding: 5rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .section-cta-about::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 120%, rgba(15,52,96,0.6) 0%, transparent 60%);
    }
    .cta-about-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        font-weight: 700;
        color: var(--white);
        margin-bottom: 1rem;
        position: relative;
    }
    .cta-about-title span { color: var(--accent); }
    .cta-about-desc {
        color: rgba(255,255,255,0.45);
        font-size: 0.92rem;
        max-width: 460px;
        margin: 0 auto 2rem;
        line-height: 1.8;
        position: relative;
    }
    .btn-cta-gold {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: var(--accent);
        color: var(--primary);
        font-weight: 700;
        font-size: 0.82rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.9rem 2.5rem;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
    }
    .btn-cta-gold:hover {
        background: #e0ba7d;
        color: var(--primary);
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.2);
    }
    .btn-outline-gold {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: transparent;
        color: var(--accent);
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.9rem 2.5rem;
        border: 1.5px solid var(--accent);
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
    }
    .btn-outline-gold:hover {
        background: rgba(201,169,110,0.1);
        color: var(--accent);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .section-about-intro { padding: 3.5rem 0 3rem; }
    }
    @media (max-width: 768px) {
        .page-header { padding: 2.5rem 0 3.5rem; }
        .about-logo-box { min-height: 260px; padding: 3rem 2rem; margin-top: 2rem; }
        .section-visi, .section-nilai, .section-team { padding: 3.5rem 0; }
    }
    @media (max-width: 480px) {
        .page-header::after { display: none; }
    }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="page-header-badge">
                <i class="bi bi-building"></i> Tentang Kami
            </div>
            <h1 style="font-family:'Playfair Display',serif; color:#fff; font-size:clamp(1.9rem,5vw,3rem); font-weight:700; line-height:1.2; max-width:560px;">
                Mengenal<br><span style="color:var(--accent);">HIKO STUDIO</span>
            </h1>
            <p style="color:rgba(255,255,255,0.5); margin-top:1rem; max-width:500px; font-size:0.95rem; line-height:1.85;">
                Studio desain dan pembangunan yang berdedikasi menghadirkan ruang-ruang bernilai tinggi dengan sentuhan estetika dan perhatian mendalam pada setiap detail.
            </p>
        </div>
    </section>

    <!-- INTRO -->
    <section class="section-about-intro">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="section-label">Siapa Kami</div>
                    <h2 class="about-tagline">
                        Kami merancang ruang<br>yang <span>menginspirasi</span><br>dan bertahan lama.
                    </h2>
                    <div class="accent-bar"></div>
                    <p class="about-desc mb-4">
                        HIKO STUDIO adalah perusahaan yang bergerak di bidang desain interior, arsitektur, dan pembangunan. Kami hadir untuk mewujudkan ruang impian Anda — dengan pendekatan personal, estetika yang kuat, dan kualitas yang tidak pernah kami kompromikan.
                    </p>
                    <p class="about-desc mb-3">
                        Di balik nama <strong style="color:var(--primary);">HIKO</strong> tersimpan makna yang menjadi jiwa dari setiap karya kami:
                    </p>
                    <div class="about-meaning-card">
                        <strong>HI</strong> &mdash; <em>Hikari</em> (光) &nbsp;|&nbsp; <em>Cahaya</em>
                        <span>Melambangkan visi kami untuk terus menerangi dan menginspirasi dalam setiap karya.</span>
                    </div>
                    <div class="about-meaning-card">
                        <strong>KO</strong> &mdash; <em>Kodawari</em> (こだわり) &nbsp;|&nbsp; <em>Dedikasi &amp; Perhatian terhadap Detail</em>
                        <span>Mencerminkan komitmen kami pada kualitas dan keindahan di setiap proyek interior maupun eksterior.</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-logo-box">
                        <span class="logo-wrap" style="gap:20px; position:relative; z-index:1;">
                            <span class="logo-left">
                                <span class="logo-kanji" style="font-size:5rem;">光</span>
                                <span class="logo-kodawari" style="font-size:1rem; letter-spacing:2px;">こだわり</span>
                            </span>
                            <span class="logo-right" style="border-left:1px solid rgba(201,169,110,0.3); padding-left:20px; gap:6px;">
                                <span class="logo-main" style="font-size:3rem; letter-spacing:4px;">HIKO <span class="logo-gold">STUDIO</span></span>
                                <span class="logo-sub" style="font-size:0.72rem; letter-spacing:5px;">DESIGN. BUILD. INSPIRE.</span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section class="section-visi">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label" style="justify-content:center;">Arah Kami</div>
                <h2 class="section-title">Visi dan Misi</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="visi-card">
                        <div class="visi-icon"><i class="bi bi-eye"></i></div>
                        <div class="visi-title">Visi</div>
                        <p class="visi-text">
                            Menjadi perusahaan desain interior dan eksterior terkemuka yang memberikan dampak positif melalui ruang yang inspiratif dan berkualitas tinggi.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="visi-card">
                        <div class="visi-icon"><i class="bi bi-bullseye"></i></div>
                        <div class="visi-title">Misi</div>
                        <ul class="misi-list">
                            <li><i class="bi bi-check2"></i> Memberikan layanan desain dan pembangunan yang profesional dan inovatif untuk proyek interior maupun eksterior.</li>
                            <li><i class="bi bi-check2"></i> Menciptakan ruang yang nyaman dan mencerminkan karakter serta kebutuhan setiap klien.</li>
                            <li><i class="bi bi-check2"></i> Mengutamakan material berkualitas tinggi dan pengerjaan yang unggul dalam setiap proyek.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NILAI KAMI -->
    <section class="section-nilai">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label" style="justify-content:center;">Nilai Inti</div>
                <h2 class="section-title">Nilai yang Kami Junjung</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="nilai-item">
                        <div class="nilai-num">01</div>
                        <div>
                            <div class="nilai-title">Kualitas</div>
                            <div class="nilai-desc">Setiap detail dikerjakan dengan standar tertinggi, tanpa kompromi pada mutu material maupun craftsmanship.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="nilai-item">
                        <div class="nilai-num">02</div>
                        <div>
                            <div class="nilai-title">Integritas</div>
                            <div class="nilai-desc">Kami percaya pada kejujuran dalam setiap aspek kerja — dari penawaran harga hingga proses pengerjaan proyek.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="nilai-item">
                        <div class="nilai-num">03</div>
                        <div>
                            <div class="nilai-title">Inovasi</div>
                            <div class="nilai-desc">Kami terus mengeksplorasi ide-ide segar dan pendekatan baru untuk menghasilkan desain yang relevan dan timeless.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="nilai-item">
                        <div class="nilai-num">04</div>
                        <div>
                            <div class="nilai-title">Kolaborasi</div>
                            <div class="nilai-desc">Proyek terbaik lahir dari kerja sama yang erat antara tim kami dan klien — kami mitra, bukan sekadar vendor.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIM -->
    <section class="section-team">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label" style="justify-content:center;">Tim Kami</div>
                <h2 class="section-title">Jajaran Profesional Kami</h2>
                <p style="color:var(--gray); max-width:480px; margin:0.75rem auto 0; font-size:0.92rem; line-height:1.75; font-weight:300;">
                    Didukung oleh tenaga profesional berpengalaman yang berdedikasi penuh dalam menghadirkan hasil terbaik di setiap proyek.
                </p>
            </div>
            <div class="row g-4">
                @foreach($teamMembers as $anggota)
                <div class="col-md-6 col-lg-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            @if($anggota->photo)
                                <img src="{{ asset('storage/' . $anggota->photo) }}"
                                     alt="{{ $anggota->name }}"
                                     style="width:100%;height:100%;object-fit:cover;object-position:center 20%;position:absolute;inset:0;">
                            @else
                                <i class="bi bi-person team-avatar-icon"></i>
                                <span class="team-avatar-initials">{{ $anggota->initials }}</span>
                            @endif
                        </div>
                        <div class="team-body">
                            <div class="team-name">{{ $anggota->name }}</div>
                            <div class="team-role">{{ $anggota->role }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-cta-about">
        <div class="container" style="position:relative; z-index:1;">
            <h2 class="cta-about-title">
                Siap Bekerja Sama<br>dengan <span>HIKO STUDIO?</span>
            </h2>
            <p class="cta-about-desc">
                Konsultasikan kebutuhan proyek Anda kepada kami secara gratis. Tim profesional kami siap membantu mewujudkan ruang impian Anda.
            </p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="{{ route('kontak.index') }}" class="btn-cta-gold">
                    <i class="bi bi-envelope"></i> Hubungi Kami
                </a>
                <a href="{{ route('layanan.index') }}" class="btn-outline-gold">
                    <i class="bi bi-grid-3x3-gap"></i> Lihat Layanan
                </a>
            </div>
        </div>
    </section>

@endsection
