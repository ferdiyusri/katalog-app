<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Admin') — HIKO STUDIO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:       #1a1a2e;
            --primary-light: #22223a;
            --accent:        #c9a96e;
            --accent-light:  #e8d5b0;
            --dark:          #0f0f1a;
            --light:         #f4f4f8;
            --white:         #ffffff;
            --gray:          #8a8fa8;
            --border:        rgba(0,0,0,0.07);
            --success:       #22c55e;
            --danger:        #ef4444;
            --warning:       #f59e0b;
            --sidebar-w:     260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            color: #2d2d3a;
            overflow-x: hidden;
        }

        /* ===========================
           SIDEBAR
        =========================== */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(180deg, #1e1e33 0%, #181828 100%);
            border-right: 1px solid rgba(201,169,110,0.08);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.3s ease;
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 2px; }

        /* Brand */
        .sidebar-brand {
            padding: 1.4rem 1.5rem 1.2rem;
            border-bottom: 1px solid rgba(201,169,110,0.12);
            flex-shrink: 0;
        }

        .sidebar-brand-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 38px;
            height: 38px;
            background: rgba(201,169,110,0.15);
            border: 1px solid rgba(201,169,110,0.3);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--accent);
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            line-height: 1;
        }

        .sidebar-brand-name span { color: var(--accent); }

        .sidebar-brand-sub {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.3);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* Section label */
        .sidebar-section {
            padding: 1.4rem 1.5rem 0.4rem;
            font-size: 0.63rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
        }

        /* Nav item */
        .sidebar-menu {
            list-style: none;
            padding: 0 0.75rem;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.62rem 0.85rem;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s ease;
            margin-bottom: 1px;
            position: relative;
        }

        .sidebar-menu li a:hover {
            color: rgba(255,255,255,0.85);
            background: rgba(255,255,255,0.05);
        }

        .sidebar-menu li a.active {
            color: var(--accent);
            background: rgba(201,169,110,0.1);
        }

        .sidebar-menu li a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 3px;
            background: var(--accent);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-menu li a i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .badge-count {
            margin-left: auto;
            background: var(--accent);
            color: var(--primary);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.5rem;
            border-radius: 20px;
            line-height: 1.5;
        }

        .badge-count.danger {
            background: var(--danger);
            color: #fff;
        }

        /* Sidebar footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.06);
            flex-shrink: 0;
        }

        .sidebar-footer form { display: contents; }

        .sidebar-footer-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255,255,255,0.3);
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            padding: 0.5rem 0.85rem;
            border-radius: 6px;
            transition: all 0.2s;
            text-align: left;
        }

        .sidebar-footer-btn:hover {
            background: rgba(239,68,68,0.08);
            color: #ef8080;
        }

        /* ===========================
           MAIN CONTENT
        =========================== */
        .main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===========================
           TOPBAR
        =========================== */
        .topbar {
            background: var(--white);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--primary);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
        }

        .topbar-breadcrumb {
            display: flex;
            flex-direction: column;
        }

        .topbar-breadcrumb h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            line-height: 1.2;
        }

        .topbar-breadcrumb p {
            font-size: 0.78rem;
            color: var(--gray);
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar-icon-btn {
            position: relative;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray);
            font-size: 1rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .topbar-icon-btn:hover { background: var(--light); color: var(--primary); }

        .topbar-notif-dot {
            position: absolute;
            top: 6px; right: 6px;
            width: 7px; height: 7px;
            background: var(--danger);
            border-radius: 50%;
            border: 1.5px solid var(--white);
        }

        .topbar-divider {
            width: 1px;
            height: 24px;
            background: var(--border);
            margin: 0 0.25rem;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            cursor: default;
        }

        .topbar-avatar {
            width: 34px;
            height: 34px;
            background: var(--primary);
            color: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .topbar-user-info { display: flex; flex-direction: column; }
        .topbar-user-name { font-size: 0.82rem; font-weight: 600; color: var(--primary); line-height: 1.2; }
        .topbar-user-role { font-size: 0.7rem; color: var(--gray); }

        /* ===========================
           PAGE CONTENT AREA
        =========================== */
        .page-body { padding: 1.75rem 2rem; flex: 1; }

        /* ===========================
           STAT CARDS
        =========================== */
        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 3px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .stat-card:hover::after { transform: scaleX(1); }

        .stat-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .stat-card-icon.gold   { background: rgba(201,169,110,0.12); color: var(--accent); }
        .stat-card-icon.blue   { background: rgba(99,102,241,0.1);   color: #6366f1; }
        .stat-card-icon.green  { background: rgba(34,197,94,0.1);    color: #16a34a; }
        .stat-card-icon.purple { background: rgba(168,85,247,0.1);   color: #9333ea; }
        .stat-card-icon.red    { background: rgba(239,68,68,0.1);    color: #dc2626; }

        .stat-card-value {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-card-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===========================
           CONTENT CARD
        =========================== */
        .content-card {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .content-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .content-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .content-card-body { padding: 1.5rem; }

        /* ===========================
           QUICK ACTION CARDS
        =========================== */
        .quick-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
            text-decoration: none;
            display: block;
            transition: all 0.25s ease;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .quick-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: rgba(201,169,110,0.3);
        }

        .quick-card-icon {
            width: 40px;
            height: 40px;
            background: rgba(201,169,110,0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
        }

        .quick-card h5 {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.2rem;
        }

        .quick-card p {
            font-size: 0.75rem;
            color: var(--gray);
            margin: 0;
            line-height: 1.4;
        }

        /* ===========================
           BUTTONS
        =========================== */
        .btn-primary-custom {
            background: var(--accent);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary-custom:hover { background: #b8935a; color: var(--primary); }
        .btn-primary-custom:disabled { opacity: 0.5; cursor: not-allowed; }

        /* alias for old btn-add */
        .btn-add {
            background: var(--accent);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add:hover { background: #b8935a; color: var(--primary); }
        .btn-add:disabled { opacity: 0.5; cursor: not-allowed; }

        .btn-secondary-custom {
            background: var(--white);
            color: var(--primary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary-custom:hover { background: var(--light); color: var(--primary); border-color: #ccc; }

        .btn-cancel {
            background: var(--white);
            color: var(--gray);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover { border-color: #aaa; color: var(--primary); }

        .btn-submit {
            background: var(--accent);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.7rem 2rem;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-submit:hover { background: #b8935a; color: var(--primary); }

        /* ===========================
           TABLE
        =========================== */
        .table-custom { margin: 0; border-collapse: separate; border-spacing: 0; }

        .table-custom thead th {
            background: #fafafa;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gray);
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--border);
            border-top: none;
            white-space: nowrap;
        }

        .table-custom tbody td {
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
            color: #3d3d50;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            vertical-align: middle;
        }

        .table-custom tbody tr:last-child td { border-bottom: none; }

        .table-custom tbody tr:hover td { background: rgba(201,169,110,0.03); }

        .table-badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
        }

        .table-badge.interior  { background: rgba(201,169,110,0.12); color: #a08340; }
        .table-badge.sipil     { background: rgba(26,26,46,0.08);    color: var(--primary); }
        .table-badge.new       { background: rgba(239,68,68,0.1);    color: #dc2626; }
        .table-badge.read      { background: rgba(34,197,94,0.1);    color: #16a34a; }

        .table-product-name {
            font-weight: 600;
            color: var(--primary);
            font-size: 0.875rem;
        }

        .table-img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 6px;
        }

        .table-img-placeholder {
            width: 42px;
            height: 42px;
            background: var(--light);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1rem;
            opacity: 0.5;
        }

        .btn-table-action {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--gray);
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-table-action:hover        { background: var(--light); border-color: var(--accent); color: var(--accent); }
        .btn-table-action.delete:hover { background: #fef2f2; border-color: var(--danger); color: var(--danger); }

        /* ===========================
           EMPTY STATE
        =========================== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            background: rgba(201,169,110,0.08);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--accent);
            margin: 0 auto 1.25rem;
            opacity: 0.7;
        }

        .empty-state h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .empty-state p {
            color: var(--gray);
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        /* alias */
        .empty-table { text-align: center; padding: 4rem 2rem; }
        .empty-table i { font-size: 2.5rem; color: var(--accent); opacity: 0.3; margin-bottom: 1rem; display: block; }
        .empty-table h4 { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--primary); margin-bottom: 0.5rem; }
        .empty-table p { color: var(--gray); font-size: 0.875rem; margin-bottom: 1.25rem; }

        /* ===========================
           FORM
        =========================== */
        .form-content { padding: 1.75rem 2rem; max-width: 860px; }

        .form-label-custom {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 0.4rem;
            display: block;
        }

        .form-control-custom,
        .form-select-custom {
            border: 1.5px solid #e5e5ed;
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            background: #fafafa;
            color: var(--primary);
            transition: all 0.2s ease;
            display: block;
            width: 100%;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.12);
            background: var(--white);
        }

        .form-control-custom.is-invalid { border-color: var(--danger); }

        .form-hint {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.3rem;
        }

        .upload-area {
            border: 2px dashed rgba(201,169,110,0.25);
            border-radius: 12px;
            background: rgba(201,169,110,0.02);
            padding: 2.5rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .upload-area:hover { border-color: var(--accent); background: rgba(201,169,110,0.05); }
        .upload-area i { font-size: 2rem; color: var(--accent); opacity: 0.5; margin-bottom: 0.5rem; display: block; }
        .upload-area p { color: var(--gray); font-size: 0.875rem; margin: 0; }
        .upload-area small { font-size: 0.75rem; color: var(--gray); opacity: 0.7; }
        .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

        /* ===========================
           ALERTS
        =========================== */
        .alert-success-custom {
            background: rgba(34,197,94,0.07);
            border-left: 4px solid var(--success);
            border-radius: 0 8px 8px 0;
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
            color: #15803d;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .alert-error-custom {
            background: rgba(239,68,68,0.07);
            border-left: 4px solid var(--danger);
            border-radius: 0 8px 8px 0;
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
            color: #b91c1c;
            margin-bottom: 1.5rem;
        }

        .alert-error-custom ul { margin: 0.4rem 0 0; padding-left: 1.2rem; }

        /* ===========================
           SIDEBAR GROUP ACCORDION
        =========================== */
        .sidebar-group-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.9rem 1.5rem 0.3rem;
            font-size: 0.63rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            font-family: 'DM Sans', sans-serif;
            transition: color 0.2s;
        }

        .sidebar-group-toggle:hover { color: rgba(255,255,255,0.55); }

        .sidebar-chevron {
            font-size: 0.7rem;
            transition: transform 0.25s ease;
            color: rgba(255,255,255,0.2);
        }

        .sidebar-group-toggle[aria-expanded="true"] .sidebar-chevron { transform: rotate(180deg); }

        /* ===========================
           SIDEBAR OVERLAY
        =========================== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 999;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.show { display: block; }

        /* ===========================
           RESPONSIVE
        =========================== */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .topbar-toggle { display: flex; }
            .topbar-user-info { display: none; }
        }

        /* ===========================
           FOOTER
        =========================== */
        .admin-footer {
            padding: 0.8rem 2rem;
            border-top: 1px solid var(--border);
            background: var(--white);
            font-size: 0.72rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-shrink: 0;
        }

        .admin-footer-brand {
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.5px;
        }

        .admin-footer-brand span { color: var(--accent); }

        @media (max-width: 768px) {
            .page-body { padding: 1.25rem; }
            .form-content { padding: 1.25rem; max-width: 100%; }
            .topbar { padding: 0 1.25rem; }
            .stat-card-value { font-size: 1.6rem; }
            .admin-footer { padding: 0.75rem 1.25rem; flex-direction: column; text-align: center; gap: 0.25rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

    @php
        $totalProducts   = \App\Models\Product::count();
        $totalRegistrasi = \App\Models\PriceRegistration::count();
        $totalEnquiryBaru = \App\Models\Enquiry::where('is_read', false)->count();
        $adminUser = auth()->user();
        $adminInitial = $adminUser ? strtoupper(substr($adminUser->name ?? $adminUser->email, 0, 1)) : 'A';
    @endphp

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <a href="{{ url('/') }}" class="sidebar-brand-link">
                <div class="sidebar-brand-icon">光</div>
                <div class="sidebar-brand-text">
                    <span class="sidebar-brand-name">HIKO <span>STUDIO</span></span>
                    <span class="sidebar-brand-sub">Admin Panel</span>
                </div>
            </a>
        </div>

        @php
            $dashboardActive = request()->routeIs('admin.products.index') && !request('kategori') || request()->routeIs('admin.products.create');
        @endphp
        <button class="sidebar-group-toggle"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarDashboard"
                aria-expanded="{{ $dashboardActive ? 'true' : 'false' }}">
            <span>Dashboard</span>
            <i class="bi bi-chevron-down sidebar-chevron"></i>
        </button>
        <div id="sidebarDashboard" class="collapse {{ $dashboardActive ? 'show' : '' }}">
            <ul class="sidebar-menu" style="padding-top:0.2rem; padding-bottom:0.4rem;">
                <li>
                    <a href="{{ route('admin.products.index') }}"
                       class="{{ request()->routeIs('admin.products.index') && !request('kategori') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Overview</span>
                        <span class="badge-count">{{ $totalProducts }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.create') }}"
                       class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                        <i class="bi bi-plus-square"></i>
                        <span>Tambah Produk</span>
                    </a>
                </li>
            </ul>
        </div>

        @php
            $sidebarGroups = \App\Models\CategoryGroup::with(['categories' => fn($q) => $q->orderBy('urutan')])->orderBy('urutan')->get();
        @endphp

        @foreach($sidebarGroups as $sgrp)
            @if($sgrp->categories->isNotEmpty())
            @php
                $grpActive    = $sgrp->categories->contains(fn($c) => request('kategori') == $c->slug);
                $collapseId   = 'sidebarGrp' . $sgrp->id;
            @endphp
            <button class="sidebar-group-toggle"
                    data-bs-toggle="collapse"
                    data-bs-target="#{{ $collapseId }}"
                    aria-expanded="{{ $grpActive ? 'true' : 'false' }}">
                <span>{{ $sgrp->name }}</span>
                <i class="bi bi-chevron-down sidebar-chevron"></i>
            </button>
            <div id="{{ $collapseId }}" class="collapse {{ $grpActive ? 'show' : '' }}">
                <ul class="sidebar-menu" style="padding-top:0.2rem; padding-bottom:0.4rem;">
                    @foreach($sgrp->categories as $sk)
                    <li>
                        <a href="{{ route('admin.products.index', ['kategori' => $sk->slug]) }}"
                           class="{{ request('kategori') == $sk->slug ? 'active' : '' }}">
                            <i class="bi bi-tag"></i> {{ $sk->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        @endforeach

        @php
            $pelangganActive = request()->routeIs('admin.registrasi.*') || request()->routeIs('admin.enquiry.*');
        @endphp
        <button class="sidebar-group-toggle"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarPelanggan"
                aria-expanded="{{ $pelangganActive ? 'true' : 'false' }}">
            <span>Pelanggan</span>
            <i class="bi bi-chevron-down sidebar-chevron"></i>
        </button>
        <div id="sidebarPelanggan" class="collapse {{ $pelangganActive ? 'show' : '' }}">
            <ul class="sidebar-menu" style="padding-top:0.2rem; padding-bottom:0.4rem;">
                <li>
                    <a href="{{ route('admin.registrasi.index') }}"
                       class="{{ request()->routeIs('admin.registrasi.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Data Registrasi</span>
                        @if($totalRegistrasi > 0)
                            <span class="badge-count">{{ $totalRegistrasi }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.enquiry.index') }}"
                       class="{{ request()->routeIs('admin.enquiry.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i>
                        <span>Pesan Enquiry</span>
                        @if($totalEnquiryBaru > 0)
                            <span class="badge-count danger">{{ $totalEnquiryBaru }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        @if(auth()->user()->isAdmin())
        @php
            $pengaturanActive = request()->routeIs('admin.kategori.*') || request()->routeIs('admin.kelompok.*') || request()->routeIs('admin.tim.*') || request()->routeIs('admin.site-images.*');
            $sistemActive     = request()->routeIs('admin.users.*') || request()->routeIs('admin.logs.*');
        @endphp
        <button class="sidebar-group-toggle"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarPengaturan"
                aria-expanded="{{ $pengaturanActive ? 'true' : 'false' }}">
            <span>Pengaturan</span>
            <i class="bi bi-chevron-down sidebar-chevron"></i>
        </button>
        <div id="sidebarPengaturan" class="collapse {{ $pengaturanActive ? 'show' : '' }}">
            <ul class="sidebar-menu" style="padding-top:0.2rem; padding-bottom:0.4rem;">
                <li>
                    <a href="{{ route('admin.kategori.index') }}"
                       class="{{ request()->routeIs('admin.kategori.*') || request()->routeIs('admin.kelompok.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i> Kelola Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tim.index') }}"
                       class="{{ request()->routeIs('admin.tim.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Kelola Tim
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.site-images.index') }}"
                       class="{{ request()->routeIs('admin.site-images.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Gambar Website
                    </a>
                </li>
            </ul>
        </div>

        <button class="sidebar-group-toggle"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarSistem"
                aria-expanded="{{ $sistemActive ? 'true' : 'false' }}">
            <span>Sistem</span>
            <i class="bi bi-chevron-down sidebar-chevron"></i>
        </button>
        <div id="sidebarSistem" class="collapse {{ $sistemActive ? 'show' : '' }}">
            <ul class="sidebar-menu" style="padding-top:0.2rem; padding-bottom:0.4rem;">
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-person-gear"></i> Kelola Admin
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logs.index') }}"
                       class="{{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                        <i class="bi bi-shield-check"></i> Log Aktivitas
                    </a>
                </li>
            </ul>
        </div>
        @endif

        <ul class="sidebar-menu">
            <li>
                <a href="{{ url('/') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-footer-btn">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="topbar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-breadcrumb">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-subtitle', 'Panel Admin HIKO STUDIO')</p>
                </div>
            </div>
            <div class="topbar-right">
                @if($totalEnquiryBaru > 0)
                <a href="{{ route('admin.enquiry.index') }}" class="topbar-icon-btn" title="{{ $totalEnquiryBaru }} pesan baru">
                    <i class="bi bi-bell"></i>
                    <span class="topbar-notif-dot"></span>
                </a>
                @endif
                <div class="topbar-divider"></div>
                <div class="topbar-user">
                    <div class="topbar-avatar">{{ $adminInitial }}</div>
                    <div class="topbar-user-info">
                        <span class="topbar-user-name">{{ $adminUser->name ?? 'Admin' }}</span>
                        <span class="topbar-user-role">Administrator</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE BODY -->
        <div class="page-body">
            @yield('content')
        </div>

        <!-- FOOTER -->
        <div class="admin-footer">
            <span><span class="admin-footer-brand">HIKO <span>STUDIO</span></span> &nbsp;·&nbsp; Panel Admin</span>
            <span>{{ now()->format('Y') }} &copy; All rights reserved</span>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    </script>
    @yield('scripts')
</body>
</html>
