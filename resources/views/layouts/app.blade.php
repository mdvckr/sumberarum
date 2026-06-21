<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title') &mdash; E-Lapor Sumberarum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <style>
        :root{
            --navy-900:#0B2545; --navy-800:#0F2E54; --navy-700:#163B68; --navy-600:#1B4F8C;
            --blue-accent:#2E7BE0; --bg-app:#F4F6FA; --bg-card:#FFFFFF; --border-c:#E3E8EF;
            --text-1:#0B2545; --text-2:#5B6478; --text-3:#8A92A3;
            --ok-bg:#E6F4EA; --ok-text:#1E7B34; --warn-bg:#FFF4DE; --warn-text:#9A6700;
            --info-bg:#E8F0FC; --info-text:#1B4F8C; --bad-bg:#FCEAEA; --bad-text:#B23A3A;
        }
        *{box-sizing:border-box;}
        body{margin:0; font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg-app); color:var(--text-1);}
        a{text-decoration:none; color:inherit;}
        .app-shell{display:flex; min-height:100vh;}
        .sidebar{width:264px; min-width:264px; background:linear-gradient(180deg,var(--navy-900) 0%, var(--navy-800) 60%, var(--navy-700) 100%); color:#fff; display:flex; flex-direction:column; padding:24px 18px;}
        .side-brand{display:flex; align-items:center; gap:10px; padding:0 6px 22px; border-bottom:1px solid rgba(255,255,255,.12); margin-bottom:18px;}
        .side-brand-mark{width:36px; height:36px; border-radius:9px; background:rgba(255,255,255,.12); display:flex; align-items:center; justify-content:center; font-size:18px; color:#BFD7FF;}
        .side-brand-text{font-size:13.5px; font-weight:600; line-height:1.3;}
        .side-brand-text span{display:block; font-size:11px; font-weight:400; color:#9FB6D9;}
        .side-user{display:flex; align-items:center; gap:10px; background:rgba(255,255,255,.07); border-radius:10px; padding:10px 12px; margin-bottom:18px;}
        .side-user-avatar{width:32px; height:32px; border-radius:50%; background:var(--blue-accent); display:flex; align-items:center; justify-content:center; font-size:12.5px; font-weight:600;}
        .side-user-name{font-size:12.5px; font-weight:600; line-height:1.3;}
        .side-user-role{font-size:10.5px; color:#9FB6D9;}
        .side-nav{display:flex; flex-direction:column; gap:3px; flex:1;}
        .side-link{display:flex; align-items:center; gap:11px; padding:10px 12px; border-radius:9px; font-size:13.5px; color:#C7D5EA; transition:.15s;}
        .side-link i{font-size:18px; width:18px;}
        .side-link:hover{background:rgba(255,255,255,.08); color:#fff;}
        .side-link.active{background:var(--blue-accent); color:#fff; font-weight:600;}
        .side-logout{margin-top:auto; padding-top:14px; border-top:1px solid rgba(255,255,255,.12);}
        .side-logout button{width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:9px; background:transparent; border:none; color:#E8BFC0; font-size:13.5px; font-family:inherit; cursor:pointer;}
        .side-logout button:hover{background:rgba(255,255,255,.08);}
        .main{flex:1; display:flex; flex-direction:column; min-width:0;}
        .topbar{height:64px; background:#fff; border-bottom:1px solid var(--border-c); display:flex; align-items:center; justify-content:space-between; padding:0 28px;}
        .topbar h1{font-size:17px; font-weight:600; margin:0;}
        .topbar .sub{font-size:12px; color:var(--text-3); margin-top:1px;}
        .content{padding:26px 28px 40px;}
        .alert{padding:12px 16px; border-radius:10px; font-size:13.5px; margin-bottom:18px; display:flex; align-items:center; gap:8px;}
        .alert-success{background:var(--ok-bg); color:var(--ok-text);}
        .alert-danger{background:var(--bad-bg); color:var(--bad-text);}
        .card{background:var(--bg-card); border:1px solid var(--border-c); border-radius:14px;}
        .card-head{padding:16px 20px; border-bottom:1px solid var(--border-c); display:flex; align-items:center; justify-content:space-between;}
        .card-head h2{font-size:14.5px; font-weight:600; margin:0;}
        .card-body{padding:20px;}
        table{width:100%; border-collapse:collapse; font-size:13px;}
        thead th{text-align:left; padding:11px 18px; font-size:11.5px; text-transform:uppercase; letter-spacing:.03em; color:var(--text-3); background:#F9FAFC; border-bottom:1px solid var(--border-c);}
        tbody td{padding:13px 18px; border-bottom:1px solid var(--border-c); vertical-align:middle;}
        tbody tr:last-child td{border-bottom:none;}
        .badge{display:inline-flex; align-items:center; gap:4px; font-size:11.5px; font-weight:600; padding:4px 10px; border-radius:7px;}
        .badge-warn{background:var(--warn-bg); color:var(--warn-text);}
        .badge-info{background:var(--info-bg); color:var(--info-text);}
        .badge-ok{background:var(--ok-bg); color:var(--ok-text);}
        .badge-bad{background:var(--bad-bg); color:var(--bad-text);}
        .badge-neutral{background:#EEF1F6; color:var(--text-2);}
        .btn{display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; padding:9px 16px; border-radius:9px; border:none; cursor:pointer; font-family:inherit;}
        .btn-primary{background:linear-gradient(135deg,var(--blue-accent),var(--navy-700)); color:#fff;}
        .btn-primary:hover{opacity:.92;}
        .btn-outline{background:#fff; color:var(--text-1); border:1px solid var(--border-c);}
        .btn-outline:hover{background:#F9FAFC;}
        .btn-success{background:var(--ok-text); color:#fff;}
        .btn-danger{background:var(--bad-text); color:#fff;}
        .btn-sm{padding:6px 12px; font-size:12px;}
        .stat-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:22px;}
        .stat-card{background:#fff; border:1px solid var(--border-c); border-radius:13px; padding:16px 18px;}
        .stat-card .num{font-size:24px; font-weight:700; color:var(--navy-900);}
        .stat-card .label{font-size:12px; color:var(--text-3); margin-top:2px;}
        .form-label{display:block; font-size:12.5px; font-weight:600; color:var(--text-1); margin-bottom:6px;}
        .form-control,.form-select,textarea.form-control{width:100%; padding:10px 13px; border:1px solid var(--border-c); border-radius:9px; font-size:13.5px; font-family:inherit; background:#fff; color:var(--text-1);}
        .form-control:focus,.form-select:focus,textarea:focus{outline:none; border-color:var(--blue-accent); box-shadow:0 0 0 3px rgba(46,123,224,.12);}
        .form-group{margin-bottom:16px;}
        .form-row{display:grid; grid-template-columns:1fr 1fr; gap:14px;}
        .empty-state{text-align:center; padding:40px 20px; color:var(--text-3); font-size:13px;}
    </style>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="side-brand">
            <div class="side-brand-mark"><i class="ti ti-building-bank"></i></div>
            <div class="side-brand-text">E-Lapor Sumberarum<span>Kalurahan Sumberarum</span></div>
        </div>
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
