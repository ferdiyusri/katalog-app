<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIKO STUDIO - Login</title>
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

        .login-wrapper {
            display: flex;
            width: 900px;
            min-height: 520px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        }

        /* Panel kiri */
        .login-left {
            width: 45%;
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

        .login-left-bottom h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--white);
            font-weight: 600;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .login-left-bottom p {
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

        /* Panel kanan */
        .login-right {
            width: 55%;
            background: var(--light);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .login-subtitle {
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

        .form-group { margin-bottom: 1.25rem; }

        .error-text {
            font-size: 0.78rem;
            color: var(--danger);
            margin-top: 0.35rem;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-row input[type="checkbox"] {
            accent-color: var(--accent);
            width: 15px;
            height: 15px;
        }

        .remember-row label {
            font-size: 0.85rem;
            color: var(--gray);
            cursor: pointer;
        }

        .btn-login {
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
        }

        .btn-login:hover {
            background: var(--primary);
            color: var(--white);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.83rem;
            color: var(--gray);
        }

        .login-footer a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            color: var(--primary);
        }

        .alert-error {
            background: rgba(231,76,60,0.08);
            border: 1px solid rgba(231,76,60,0.2);
            color: #c0392b;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                width: 100%;
                min-height: 100vh;
                flex-direction: column;
                box-shadow: none;
            }

            .login-left {
                width: 100%;
                padding: 2rem 1.5rem;
                min-height: auto;
            }

            .login-left-bottom { display: none; }

            .login-right {
                width: 100%;
                padding: 2rem 1.5rem;
                flex: 1;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Kiri -->
    <div class="login-left">
        <div>
            <div class="brand">HIKO <span>STUDIO</span></div>
            <div class="brand-tagline">Admin Panel</div>
        </div>
        <div class="login-left-bottom">
            <div class="accent-line"></div>
            <h2>Kelola Produk Anda</h2>
            <p>Masuk untuk mengelola produk interior dan build & desain HIKO STUDIO dengan mudah.</p>
        </div>
    </div>

    <!-- Kanan -->
    <div class="login-right">
        <div class="login-title">Selamat Datang</div>
        <div class="login-subtitle">Masuk ke akun admin Anda</div>

        @if(session('status'))
        <div class="alert-error" style="background:rgba(46,204,113,0.08);border-color:rgba(46,204,113,0.2);color:#1e8449;">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label-custom">Email</label>
                <input type="email" name="email" class="form-control-custom"
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="admin@email.com">
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Password</label>
                <input type="password" name="password" class="form-control-custom"
                       required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

    </div>

</div>

</body>
</html>
