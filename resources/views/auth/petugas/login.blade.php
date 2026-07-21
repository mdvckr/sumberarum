<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="layout-centered auth-bg">
    <div class="form-card admin-card">
                <a href="{{ route('home') }}" class="brand" style="justify-content: center; margin-bottom: 24px; display: flex;">
            <img src="{{ asset('images/logo-kelurahan.jpg') }}" alt="Logo" class="brand-mark" style="object-fit: cover; background: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="brand-text" style="color: var(--navy-900);">E-Lapor Sumberarum<span style="color: #5B6478;">Kalurahan Sumberarum</span></div>
        </a>
        <div class="header" style="text-align: center; margin-bottom: 24px;">
        <h1>Login petugas lapangan</h1>
        <p class="sub">Tindak lanjuti dan perbarui status pengaduan</p>
        </div>

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

        <form method="POST" action="{{ route('petugas.login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username petugas" value="{{ old('username') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <div class="alt-link" style="margin-top: 16px; text-align: center; font-size: 13.5px;">
            Petugas baru? <a href="{{ route('petugas.register') }}" style="color: var(--blue-accent); font-weight: 600;">Daftar di sini</a>
        </div>

        <div class="role-switch">
            <a href="{{ route('warga.login') }}"><i class="ti ti-user"></i> Warga</a>
            <a href="{{ route('admin.login') }}"><i class="ti ti-shield-lock"></i> Admin</a>
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
