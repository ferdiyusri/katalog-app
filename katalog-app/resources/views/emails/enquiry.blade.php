<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Baru - HIKO STUDIO</title>
    <style>
        body { margin: 0; padding: 0; background: #f4f4f4; font-family: 'Arial', sans-serif; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #ffffff; }
        .header { background: #1a1a2e; padding: 28px 32px; border-bottom: 3px solid #c9a96e; }
        .header-logo { font-size: 1.4rem; font-weight: 700; color: #ffffff; letter-spacing: 2px; text-transform: uppercase; }
        .header-logo span { color: #c9a96e; }
        .header-sub { font-size: 0.72rem; color: rgba(255,255,255,0.45); letter-spacing: 3px; text-transform: uppercase; margin-top: 4px; }
        .body { padding: 32px; }
        .title { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
        .subtitle { font-size: 0.85rem; color: #888; margin-bottom: 28px; }
        .field { margin-bottom: 20px; }
        .field-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #c9a96e; margin-bottom: 6px; }
        .field-value { font-size: 0.92rem; color: #333; background: #f8f6f2; padding: 10px 14px; border-left: 3px solid #c9a96e; line-height: 1.6; }
        .divider { border: none; border-top: 1px solid #eee; margin: 24px 0; }
        .footer { background: #0f0f1a; padding: 20px 32px; text-align: center; }
        .footer p { font-size: 0.75rem; color: rgba(255,255,255,0.3); margin: 0; line-height: 1.8; }
        .footer a { color: #c9a96e; text-decoration: none; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-logo">HIKO <span>STUDIO</span></div>
            <div class="header-sub">Design. Build. Inspire.</div>
        </div>
        <div class="body">
            <div class="title">Enquiry Baru Masuk</div>
            <div class="subtitle">Seseorang telah mengirimkan pertanyaan melalui website HIKO STUDIO.</div>

            <div class="field">
                <div class="field-label">Nama</div>
                <div class="field-value">{{ $data['nama'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email</div>
                <div class="field-value">{{ $data['email'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">Telepon</div>
                <div class="field-value">{{ $data['telepon'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">Layanan yang Diminati</div>
                <div class="field-value">{{ $data['layanan'] }}</div>
            </div>

            <hr class="divider">

            <div class="field">
                <div class="field-label">Pesan</div>
                <div class="field-value" style="white-space: pre-line;">{{ $data['pesan'] }}</div>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis dari website <a href="#">hikostudio.com</a><br>
            +62 851-1141-7001 &nbsp;|&nbsp; Setu Pladen, Kota Depok, Jawa Barat</p>
        </div>
    </div>
</body>
</html>
