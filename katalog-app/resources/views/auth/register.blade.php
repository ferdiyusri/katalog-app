<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIKO STUDIO - Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #c9a96e;
            --light: #f8f6f2;
            --gray: #6c757d;
            --white: #ffffff;
            --danger: #e74c3c;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-wrapper {
            display: flex;
            width: 900px;
            min-height: 580px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        }

        .register-left {
            width: 40%;
            background: linear-gradient(160deg, #1a1a2e 60%, #22223a 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 1px solid rgba(201,169,110,0.1);
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 2px;
        }

        .brand span { color: var(--accent); }

        .brand-tagline {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.3);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 0.4rem;
        }

        .register-left-bottom h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--white);
            font-weight: 600;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .register-left-bottom p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.4);
            line-height: 1.7;
        }

        .accent-line {
            width: 40px;
            height: 2px;
            background: var(--accent);
            margin: 1.5rem 0;
        }

        .register-right {
            width: 60%;
            background: var(--light);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .register-subtitle {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 2rem;
        }

        .form-label-custom {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 0.4rem;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            border: 1.5px solid rgba(0,0,0,0.1);
            border-radius: 0;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.12);
        }

        .form-group { margin-bottom: 1.1rem; }

        .error-text {
            font-size: 0.78rem;
            color: var(--danger);
            margin-top: 0.35rem;
        }

        .btn-register {
            width: 100%;
            background: var(--accent);
            color: var(--primary);
            border: none;
            padding: 0.85rem;
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 0;
            margin-top: 0.5rem;
        }

        .btn-register:hover {
            background: var(--primary);
            color: var(--white);
        }

        .register-footer {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.83rem;
            color: var(--gray);
        }

        .register-footer a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .register-wrapper {
                width: 100%;
                min-height: 100vh;
                flex-direction: column;
                box-shadow: none;
            }

            .register-left {
                width: 100%;
                padding: 2rem 1.5rem;
                min-height: auto;
            }

            .register-left-bottom { display: none; }

            .register-right {
                width: 100%;
                padding: 2rem 1.5rem;
                flex: 1;
            }
        }
    </style>
</head>
<body>

<div class="register-wrapper">

    <!-- Kiri -->
    <div class="register-left">
        <div>
            <div class="brand">HIKO <span>STUDIO</span></div>
            <div class="brand-tagline">Admin Panel</div>
        </div>
        <div class="register-left-bottom">
            <div class="accent-line"></div>
            <h2>Buat Akun Admin Baru</h2>
            <p>Daftarkan akun untuk mulai mengelola produk HIKO STUDIO.</p>
        </div>
    </div>

    <!-- Kanan -->
    <div class="register-right">
        <div class="register-title">Buat Akun</div>
        <div class="register-subtitle">Isi form di bawah untuk mendaftar</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label-custom">Nama</label>
                <input type="text" name="name" class="form-control-custom"
                       value="{{ old('name') }}" required autofocus autocomplete="name"
                       placeholder="Nama lengkap">
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Email</label>
                <input type="email" name="email" class="form-control-custom"
                       value="{{ old('email') }}" required autocomplete="username"
                       placeholder="email@contoh.com">
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Password</label>
                <input type="password" name="password" class="form-control-custom"
                       required autocomplete="new-password" placeholder="Min. 8 karakter">
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control-custom"
                       required autocomplete="new-password" placeholder="Ulangi password">
                @error('password_confirmation')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="register-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

</div>

</body>
</html>
