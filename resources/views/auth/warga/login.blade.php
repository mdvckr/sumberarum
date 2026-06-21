<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Warga &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <style>
        :root{ --navy-900:#0B2545; --navy-800:#0F2E54; --blue-accent:#2E7BE0; }
        *{box-sizing:border-box;}
        body{margin:0; font-family:'Plus Jakarta Sans',sans-serif; min-height:100vh; display:flex;}
        .side-art{flex:1; background:linear-gradient(135deg,var(--navy-900) 0%, var(--navy-800) 55%, #163B68 100%); display:flex; flex-direction:column; justify-content:space-between; padding:48px; position:relative; overflow:hidden; color:#fff;}
        .side-art::after{content:""; position:absolute; right:-100px; bottom:-100px; width:340px; height:340px; border-radius:50%; background:radial-gradient(circle, rgba(46,123,224,.35), transparent 70%);}
        .brand{display:flex; align-items:center; gap:11px; position:relative;}
        .brand-mark{width:38px; height:38px; border-radius:9px; background:rgba(255,255,255,.12); display:flex; align-items:center; justify-content:center; color:#BFD7FF; font-size:18px;}
        .brand-text{font-size:14.5px; font-weight:600;}
        .brand-text span{display:block; font-size:11.5px; font-weight:400; color:#9FB6D9;}
        .side-art h2{font-size:26px; font-weight:700; line-height:1.35; max-width:380px; position:relative; margin:0;}
        .side-art p{font-size:13.5px; color:#C7D5EA; max-width:360px; line-height:1.6; position:relative;}
        .form-side{width:460px; min-width:460px; display:flex; align-items:center; justify-content:center; background:#F4F6FA; padding:40px;}
        .form-card{width:100%; max-width:360px;}
        .form-card h1{font-size:22px; font-weight:700; margin:0 0 6px; color:var(--navy-900);}
        .form-card .sub{font-size:13px; color:#5B6478; margin:0 0 28px;}
        .form-group{margin-bottom:16px;}
        .form-label{display:block; font-size:12.5px; font-weight:600; color:var(--navy-900); margin-bottom:6px;}
        .form-control{width:100%; padding:11px 14px; border:1px solid #E3E8EF; border-radius:9px; font-size:13.5px; font-family:inherit;}
        .form-control:focus{outline:none; border-color:var(--blue-accent); box-shadow:0 0 0 3px rgba(46,123,224,.12);}
        .btn-primary{width:100%; background:linear-gradient(135deg,var(--blue-accent),#163B68); color:#fff; border:none; padding:12px; border-radius:9px; font-size:14px; font-weight:600; cursor:pointer; font-family:inherit; margin-top:6px;}
        .alt-link{text-align:center; font-size:12.5px; color:#5B6478; margin-top:18px;}
        .alt-link a{color:var(--blue-accent); font-weight:600;}
        .role-switch{display:flex; gap:8px; margin-top:22px; padding-top:18px; border-top:1px solid #E3E8EF;}
        .role-switch a{flex:1; text-align:center; font-size:12px; padding:8px; border:1px solid #E3E8EF; border-radius:8px; color:#5B6478; font-weight:600;}
        .alert-danger{background:#FCEAEA; color:#B23A3A; padding:11px 14px; border-radius:9px; font-size:12.5px; margin-bottom:16px;}
        .alert-success{background:#E6F4EA; color:#1E7B34; padding:11px 14px; border-radius:9px; font-size:12.5px; margin-bottom:16px;}
    </style>
</head>
<body>
    <div class="side-art">
        <div class="brand">
            <div class="brand-mark"><i class="ti ti-building-bank"></i></div>
            <div class="brand-text">E-Lapor Sumberarum<span>Kalurahan Sumberarum</span></div>
        </div>
        <div>
            <h2>Layanan pengaduan warga, transparan dan cepat ditindaklanjuti</h2>
            <p>Masuk untuk membuat laporan baru atau memantau status pengaduan kamu.</p>
        </div>
    </div>
    <div class="form-side">
        <div class="form-card">
            <h1>Masuk sebagai warga</h1>
            <p class="sub">Akses dashboard dan kirim pengaduan kamu</p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('warga.login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-primary">Masuk</button>
            </form>

            <div class="alt-link">Belum punya akun? <a href="{{ route('warga.register') }}">Daftar di sini</a></div>

            <div class="role-switch">
                <a href="{{ route('admin.login') }}"><i class="ti ti-shield-lock"></i> Admin</a>
                <a href="{{ route('petugas.login') }}"><i class="ti ti-tool"></i> Petugas</a>
            </div>
        </div>
    </div>
</body>
</html>
