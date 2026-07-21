<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Petugas &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="bg-light">
    <div class="top-strip">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo-kelurahan.jpg') }}" alt="Logo Sumberarum" class="brand-mark" style="object-fit: cover; background: none; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <div class="brand-text">E-Lapor Sumberarum<span>Kalurahan Sumberarum</span></div>
        </a>
    </div>
    <div class="wrap">
        <div class="form-card register-card">
            <h1>Registrasi Petugas Baru</h1>
            <p class="sub">Daftarkan akun petugas layanan pengaduan</p>

            @if($errors->any())
                <div class="alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('petugas.register') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Lengkap Petugas <span class="req">*</span></label>
                    <input type="text" name="nama_petugas" class="form-control" placeholder="Nama lengkap petugas" value="{{ old('nama_petugas') }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Username <span class="req">*</span></label>
                        <input type="text" name="username" class="form-control" placeholder="Username untuk login" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP / WhatsApp <span class="req">*</span></label>
                        <input type="text" name="no_hp" class="form-control" maxlength="15" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Jabatan / Bagian <span class="req">*</span></label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Petugas Kebersihan / Keamanan" value="{{ old('jabatan') }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Password <span class="req">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Daftar Petugas</button>
            </form>
            <div class="alt-link">Sudah punya akun petugas? <a href="{{ route('petugas.login') }}">Masuk di sini</a></div>
        </div>
    </div>
    <script>
        document.addEventListener("mousemove", function(e) {
            const x = (e.clientX / window.innerWidth - 0.5) * 30;
            const y = (e.clientY / window.innerHeight - 0.5) * 30;
            const bgs = document.querySelectorAll('body.auth-bg, .side-art, body.bg-light');
            bgs.forEach(bg => {
                bg.style.backgroundPosition = `calc(50% + ${x}px) calc(50% + ${y}px)`;
            });
        });
    </script>
</body>
</html>
