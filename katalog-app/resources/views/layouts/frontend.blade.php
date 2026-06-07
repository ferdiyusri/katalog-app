<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HIKO STUDIO') — HIKO STUDIO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:      #1a1a2e;
            --accent:       #c9a96e;
            --accent-light: #e8d5b0;
            --dark:         #0f0f1a;
            --light:        #f5f4f0;
            --gray:         #6c757d;
            --white:        #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            color: #333;
            background: var(--light);
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: var(--primary);
            padding: 0.4rem 0;
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(201,169,110,0.15);
        }

        .navbar-custom.scrolled {
            padding: 0.2rem 0;
            background: rgba(26,26,46,0.97);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }

        /* ===== LOGO ===== */
        .logo-wrap { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-left { display: flex; flex-direction: column; align-items: flex-start; line-height: 1; }
        .logo-kanji { font-family: 'Playfair Display', serif; font-size: 2.6rem; font-weight: 700; color: var(--accent); line-height: 1; }
        .logo-kodawari { font-size: 0.75rem; color: var(--accent); letter-spacing: 1px; margin-top: 2px; }
        .logo-right { display: flex; flex-direction: column; justify-content: center; gap: 2px; border-left: 1px solid rgba(201,169,110,0.3); padding-left: 12px; }
        .logo-main { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--white); letter-spacing: 2px; text-transform: uppercase; line-height: 1; }
        .logo-gold { color: var(--accent); }
        .logo-sub { font-family: 'DM Sans', sans-serif; font-size: 0.6rem; font-weight: 500; color: rgba(255,255,255,0.55); letter-spacing: 4px; text-transform: uppercase; }

        /* ===== NAV LINKS ===== */
        .nav-link-custom {
            color: rgba(255,255,255,0.75) !important;
            font-weight: 500;
            font-size: 0.92rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0.5rem 1.2rem !important;
            transition: all 0.3s ease;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active { color: var(--accent) !important; }

        .btn-nav-admin {
            background: transparent;
            border: 1.5px solid var(--accent);
            color: var(--accent) !important;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0.45rem 1.4rem !important;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .btn-nav-admin:hover { background: var(--accent); color: var(--primary) !important; }

        /* ===== DROPDOWN ===== */
        @keyframes dropFade {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .dropdown-menu-dark-custom {
            background: #12122a;
            border: 1px solid rgba(201,169,110,0.18);
            border-top: 2px solid var(--accent);
            border-radius: 0 0 4px 4px;
            padding: 0.5rem 0;
            margin-top: 0 !important;
            box-shadow: 0 16px 48px rgba(0,0,0,0.55);
            min-width: 200px;
            animation: dropFade 0.2s ease;
        }

        .dropdown-menu-dark-custom .dropdown-item {
            color: rgba(255,255,255,0.68);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 0.55rem 1.4rem;
            transition: all 0.2s ease;
            background: transparent;
        }

        .dropdown-menu-dark-custom .dropdown-item:hover {
            background: rgba(201,169,110,0.08);
            color: var(--accent);
            padding-left: 1.8rem;
        }

        .dropdown-menu-dark-custom .dropdown-header {
            color: var(--accent);
            font-size: 0.65rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 0.7rem 1.4rem 0.25rem;
            opacity: 0.55;
            font-weight: 600;
        }

        .dropdown-divider-custom { border-color: rgba(201,169,110,0.1); margin: 0.25rem 0; }

        .nav-link-custom.dropdown-toggle::after { vertical-align: 0.15em; border-color: rgba(255,255,255,0.35) transparent transparent transparent; }
        .nav-link-custom.dropdown-toggle:hover::after,
        .nav-item.dropdown.show .nav-link-custom.dropdown-toggle::after { border-color: var(--accent) transparent transparent transparent; }

        @media (max-width: 991px) {
            .navbar-collapse { background: rgba(26,26,46,0.97); padding: 1rem; }
            .logo-kanji { font-size: 2rem; }
            .logo-main  { font-size: 1.4rem; }
        }

        @media (max-width: 480px) {
            .logo-kodawari, .logo-sub { display: none; }
            .logo-kanji { font-size: 1.8rem; }
            .logo-main  { font-size: 1.2rem; }
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--dark);
            padding: 1.5rem 0 1rem;
            border-top: 1px solid rgba(201,169,110,0.08);
        }

        .footer-brand { margin-bottom: 0.4rem; }
        .footer-desc { font-size: 0.78rem; color: rgba(255,255,255,0.35); line-height: 1.5; font-weight: 300; max-width: 260px; margin-top: 0.4rem; }

        .footer-title { font-size: 0.68rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: var(--accent); margin-bottom: 0.5rem; }

        .footer-contact-item { display: flex; align-items: flex-start; gap: 0.5rem; margin-bottom: 0.3rem; }
        .footer-contact-item i { color: var(--accent); font-size: 0.78rem; margin-top: 0.2rem; flex-shrink: 0; }
        .footer-contact-item span { color: rgba(255,255,255,0.4); font-size: 0.78rem; font-weight: 300; line-height: 1.4; }

        .footer-divider { border-top: 1px solid rgba(255,255,255,0.06); margin: 0.75rem 0 0.5rem; }

        .footer-social { display: flex; gap: 0.35rem; }
        .footer-social a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 30px; height: 30px;
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.4);
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.78rem;
        }
        .footer-social a:hover { background: var(--accent); border-color: var(--accent); color: var(--primary); }

        /* ===== SHARED PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, #0d0d1f 0%, var(--primary) 45%, #0f3460 100%);
            padding: 3rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.75rem;
        }

        .section-label::before { content: ''; width: 30px; height: 1px; background: var(--accent); }
    </style>
    @yield('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom @yield('navbar-class', 'sticky-top')" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="logo-wrap">
                    <span class="logo-left">
                        <span class="logo-kanji">光</span>
                        <span class="logo-kodawari">こだわり</span>
                    </span>
                    <span class="logo-right">
                        <span class="logo-main">HIKO <span class="logo-gold">STUDIO</span></span>
                        <span class="logo-sub">DESIGN. BUILD. INSPIRE.</span>
                    </span>
                </span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('products.*') ? 'active' : '' }}"
                           href="{{ route('products.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('layanan.*') ? 'active' : '' }}"
                           href="{{ route('layanan.index') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('about.*') ? 'active' : '' }}"
                           href="{{ route('about.hiko') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('kontak.*') ? 'active' : '' }}"
                           href="{{ route('kontak.index') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-start g-3">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <span class="logo-wrap">
                            <span class="logo-left">
                                <span class="logo-kanji" style="font-size:2rem;">光</span>
                                <span class="logo-kodawari" style="font-size:0.6rem;">こだわり</span>
                            </span>
                            <span class="logo-right" style="padding-left:10px;">
                                <span class="logo-main" style="font-size:1.1rem;letter-spacing:2px;">HIKO <span class="logo-gold">STUDIO</span></span>
                                <span class="logo-sub" style="font-size:0.55rem;letter-spacing:3px;">DESIGN. BUILD. INSPIRE.</span>
                            </span>
                        </span>
                    </div>
                    <p class="footer-desc">Studio desain interior dan pembangunan yang menghadirkan karya berkualitas tinggi.</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-title">Kontak</div>
                    <div class="footer-contact-item"><i class="bi bi-geo-alt"></i><span>Setu Pladen, Gedung Putih, Kec. Beji, Kota Depok, Jawa Barat</span></div>
                    <div class="footer-contact-item"><i class="bi bi-phone"></i><span>+62 851-1141-7001</span></div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer-title">Ikuti Kami</div>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/hikostudio_/" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.tiktok.com/@hikostudio09" target="_blank"><i class="bi bi-tiktok"></i></a>
                        <a href="https://wa.me/6285111417001" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="d-flex justify-content-center">
                <p style="color:rgba(255,255,255,0.25);font-size:0.75rem;margin:0;">&copy; {{ date('Y') }} HIKO STUDIO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
