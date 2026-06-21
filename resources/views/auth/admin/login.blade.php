<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <style>
        :root{ --navy-900:#0B2545; --navy-800:#0F2E54; --blue-accent:#2E7BE0; }
        *{box-sizing:border-box;}
        body{margin:0; font-family:'Plus Jakarta Sans',sans-serif; min-height:100vh; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,var(--navy-900) 0%, var(--navy-800) 55%, #163B68 100%); position:relative; overflow:hidden;}
        body::after{content:""; position:absolute; right:-100px; top:-100px; width:380px; height:380px; border-radius:50%; background:radial-gradient(circle, rgba(46,123,224,.35), transparent 70%);}
        .form-card{width:100%; max-width:380px; background:#fff; border-radius:16px; padding:34px; position:relative;}
        .icon-top{width:48px; height:48px; border-radius:12px; background:#E8F0FC; color:#1B4F8C; display:flex; align-items:center; justify-content:center; font-size:22px; margin-bottom:18px;}
        .form-card h1{font-size:20px; font-weight:700; margin:0 0 4px; color:var(--navy-900);}
        .form-card .sub{font-size:13px; color:#5B6478; margin:0 0 24px;}
        .form-group{margin-bottom:16px;}
        .form-label{display:block; font-size:12.5px; font-weight:600; color:var(--navy-900); margin-bottom:6px;}
        .form-control{width:100%; padding:11px 14px; border:1px solid #E3E8EF; border-radius:9px; font-size:13.5px; font-family:inherit;}
        .form-control:focus{outline:none; border-color:var(--blue-accent); box-shadow:0 0 0 3px rgba(46,123,224,.12);}
        .btn-primary{width:100%; background:linear-gradient(135deg,var(--blue-accent),#163B68); color:#fff; border:none; padding:12px; border-radius:9px; font-size:14px; font-weight:600; cursor:pointer; font-family:inherit; margin-top:6px;}
        .role-switch{display:flex; gap:8px; margin-top:22px; padding-top:18px; border-top:1px solid #E3E8EF;}
        .role-switch a{flex:1; text-align:center; font-size:12px; padding:8px; border:1px solid #E3E8EF; border-radius:8px; color:#5B6478; font-weight:600;}
        .alert-danger{background:#FCEAEA; color:#B23A3A; padding:11px 14px; border-radius:9px; font-size:12.5px; margin-bottom:16px;}
    </style>
</head>
<body>
    <div class="form-card">
        <div class="icon-top"><i class="ti ti-shield-lock"></i></div>
        <h1>Login admin kelurahan</h1>
        <p class="sub">Kelola verifikasi warga dan validasi pengaduan</p>

        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username admin" value="{{ old('username') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <div class="role-switch">
            <a href="{{ route('warga.login') }}"><i class="ti ti-user"></i> Warga</a>
            <a href="{{ route('petugas.login') }}"><i class="ti ti-tool"></i> Petugas</a>
        </div>
    </div>
</body>
</html>
