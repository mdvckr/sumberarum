<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title') &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
</head>
<body class="@if(request()->is('warga*')) theme-warga @elseif(request()->is('petugas*')) theme-petugas @endif">
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="app-shell">
    <aside class="sidebar">
        <a href="{{ route('home') }}" class="side-brand">
            <img src="{{ asset('images/logo-kelurahan.jpg') }}" alt="Logo Sumberarum" style="width: 36px; height: 36px; border-radius: 9px; object-fit: cover; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="side-brand-text">E-Lapor Sumberarum<span>Kalurahan Sumberarum</span></div>
        </a>
        <div class="side-user">
            <div class="side-user-avatar">@yield('user-initial')</div>
            <div>
                <div class="side-user-name">@yield('user-name')</div>
                <div class="side-user-role">@yield('user-role')</div>
            </div>
        </div>
        <nav class="side-nav">
            @yield('sidebar')
        </nav>
        <div class="side-logout">
            <form method="POST" action="@yield('logout-route')">
                @csrf
                <button type="submit"><i class="ti ti-logout-2"></i> Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div>
                <h1>@yield('page-title')</h1>
                <div class="sub">@yield('page-sub')</div>
            </div>
        </div>
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success"><i class="ti ti-circle-check"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="ti ti-alert-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
