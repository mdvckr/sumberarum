<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Warga &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <style>
        :root{ --navy-900:#0B2545; --blue-accent:#2E7BE0; }
        *{box-sizing:border-box;}
        body{margin:0; font-family:'Plus Jakarta Sans',sans-serif; background:#F4F6FA; min-height:100vh;}
        .top-strip{background:linear-gradient(135deg,var(--navy-900),#163B68); padding:22px 0; text-align:center;}
        .brand{display:inline-flex; align-items:center; gap:10px; color:#fff;}
        .brand-mark{width:34px; height:34px; border-radius:8px; background:rgba(255,255,255,.12); display:flex; align-items:center; justify-content:center; color:#BFD7FF; font-size:16px;}
        .brand-text{font-size:13.5px; font-weight:600; text-align:left;}
        .brand-text span{display:block; font-size:11px; font-weight:400; color:#9FB6D9;}
        .wrap{max-width:620px; margin:0 auto; padding:36px 20px 60px;}
        .form-card{background:#fff; border:1px solid #E3E8EF; border-radius:16px; padding:32px;}
        .form-card h1{font-size:20px; font-weight:700; margin:0 0 4px; color:var(--navy-900);}
        .form-card .sub{font-size:13px; color:#5B6478; margin:0 0 24px;}
        .form-row{display:grid; grid-template-columns:1fr 1fr; gap:14px;}
        .form-group{margin-bottom:16px;}
        .form-label{display:block; font-size:12.5px; font-weight:600; color:var(--navy-900); margin-bottom:6px;}
        .req{color:#B23A3A;}
        .form-control{width:100%; padding:10px 13px; border:1px solid #E3E8EF; border-radius:9px; font-size:13.5px; font-family:inherit;}
        .form-control:focus{outline:none; border-color:var(--blue-accent); box-shadow:0 0 0 3px rgba(46,123,224,.12);}
        textarea.form-control{resize:vertical; min-height:64px;}
        .btn-primary{width:100%; background:linear-gradient(135deg,var(--blue-accent),#163B68); color:#fff; border:none; padding:13px; border-radius:9px; font-size:14px; font-weight:600; cursor:pointer; font-family:inherit; margin-top:8px;}
        .alt-link{text-align:center; font-size:12.5px; color:#5B6478; margin-top:18px;}
        .alt-link a{color:var(--blue-accent); font-weight:600;}
        .alert-danger{background:#FCEAEA; color:#B23A3A; padding:12px 14px; border-radius:9px; font-size:12.5px; margin-bottom:18px;}
        .alert-danger div{margin-bottom:3px;}
    </style>
</head>
<body>
    <div class="top-strip">
        <div class="brand">
            <div class="brand-mark"><i class="ti ti-building-bank"></i></div>
            <div class="brand-text">E-Lapor Sumberarum<span>Kalurahan Sumberarum</span></div>
        </div>
    </div>
    <div class="wrap">
        <div class="form-card">
            <h1>Registrasi akun warga</h1>
            <p class="sub">Lengkapi data sesuai dokumen kependudukan resmi</p>

            @if($errors->any())
                <div class="alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('warga.register') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIK <span class="req">*</span></label>
                        <input type="text" name="nik" class="form-control" maxlength="16" placeholder="16 digit NIK" value="{{ old('nik') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor KK <span class="req">*</span></label>
                        <input type="text" name="no_kk" class="form-control" maxlength="16" placeholder="16 digit No KK" value="{{ old('no_kk') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama lengkap <span class="req">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama sesuai KTP" value="{{ old('nama') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat <span class="req">*</span></label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">RT <span class="req">*</span></label>
                        <input type="text" name="rt" class="form-control" maxlength="5" placeholder="Contoh: 001" value="{{ old('rt') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">RW <span class="req">*</span></label>
                        <input type="text" name="rw" class="form-control" maxlength="5" placeholder="Contoh: 002" value="{{ old('rw') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email <span class="req">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">No. HP <span class="req">*</span></label>
                    <input type="text" name="no_hp" class="form-control" maxlength="15" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Password <span class="req">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi password <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Daftar sekarang</button>
            </form>
            <div class="alt-link">Sudah punya akun? <a href="{{ route('warga.login') }}">Masuk di sini</a></div>
        </div>
    </div>
</body>
</html>
