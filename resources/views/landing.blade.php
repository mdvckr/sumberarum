<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Lapor Sumberarum &mdash; Layanan Pengaduan Kalurahan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/dist/tabler-icons.min.css">
    <style>
        :root{ --navy-900:#0B2545; --navy-800:#0F2E54; --blue-accent:#2E7BE0; }
        *{box-sizing:border-box;}
        body{margin:0; font-family:'Plus Jakarta Sans',sans-serif; background:#F4F6FA; color:#0B2545;}
        a{text-decoration:none; color:inherit;}
        .nav{display:flex; align-items:center; justify-content:space-between; padding:18px 64px; background:var(--navy-900);}
        .brand{display:flex; align-items:center; gap:11px;}
        .brand-mark{width:38px; height:38px; border-radius:9px; background:rgba(255,255,255,.12); display:flex; align-items:center; justify-content:center; color:#BFD7FF; font-size:18px;}
        .brand-text{color:#fff; font-size:14.5px; font-weight:600;}
        .brand-text span{display:block; font-size:11.5px; font-weight:400; color:#9FB6D9;}
        .nav-links{display:flex; gap:10px;}
        .nav-btn{font-size:13.5px; padding:9px 18px; border-radius:8px; font-weight:600; border:1px solid rgba(255,255,255,.25); color:#fff;}
        .nav-btn.solid{background:#fff; color:var(--navy-900); border:none;}
        .hero{padding:72px 64px 56px; position:relative; overflow:hidden; background-image:linear-gradient(135deg, rgba(11,37,69,.55) 0%, rgba(15,46,84,.45) 55%, rgba(22,59,104,.40) 100%), url('{{ asset('images/hero-kelurahan.jpg') }}'); background-size:cover; background-position:center;}
        .hero::after{content:""; position:absolute; right:-80px; top:-80px; width:380px; height:380px; border-radius:50%; background:radial-gradient(circle, rgba(46,123,224,.25), transparent 70%);}
        .eyebrow{display:inline-flex; align-items:center; gap:7px; font-size:12.5px; color:#BFD7FF; background:rgba(255,255,255,.1); padding:6px 14px; border-radius:20px; margin-bottom:20px;}
        .hero h1{font-size:38px; font-weight:700; color:#fff; line-height:1.25; margin:0 0 16px; max-width:560px; position:relative; text-shadow:0 2px 12px rgba(0,0,0,.45);}
        .hero p{font-size:15.5px; color:#E8EEF8; max-width:480px; line-height:1.65; margin:0 0 28px; position:relative; text-shadow:0 1px 8px rgba(0,0,0,.4);}
        .hero-actions{display:flex; gap:12px; position:relative;}
        .btn-primary{background:linear-gradient(135deg,var(--blue-accent),#163B68); color:#fff; border:none; padding:13px 24px; border-radius:10px; font-size:14.5px; font-weight:600; display:inline-flex; align-items:center; gap:8px;}
        .btn-secondary{background:rgba(255,255,255,.08); color:#fff; border:1px solid rgba(255,255,255,.25); padding:13px 24px; border-radius:10px; font-size:14.5px; font-weight:600;}
        .stats{display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:rgba(255,255,255,.12); margin-top:44px; border-radius:14px; overflow:hidden; max-width:640px; position:relative;}
        .stat{background:rgba(255,255,255,.06); padding:20px 22px;}
        .stat .num{font-size:25px; font-weight:700; color:#fff;}
        .stat .label{font-size:12px; color:#9FB6D9; margin-top:3px;}
        .section{padding:56px 64px;}
        .section-head{margin-bottom:28px;}
        .section-head h2{font-size:21px; font-weight:700; margin:0 0 6px;}
        .section-head p{font-size:13.5px; color:#5B6478; margin:0;}
        .cat-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:16px;}
        .cat-card{background:#fff; border:1px solid #E3E8EF; border-radius:14px; padding:20px;}
        .cat-icon{width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:14px; font-size:19px;}
        .ic-rusak{background:#F0997B33; color:#993C1D;}
        .ic-lampu{background:#FAC77555; color:#854F0B;}
        .ic-sampah{background:#97C45955; color:#27500A;}
        .ic-air{background:#85B7EB44; color:#0C447C;}
        .cat-card h3{font-size:14.5px; font-weight:600; margin:0 0 5px;}
        .cat-card p{font-size:12.5px; color:#5B6478; margin:0; line-height:1.5;}
        .flow{background:linear-gradient(135deg,var(--navy-900),#163B68); padding:56px 64px;}
        .flow h2{color:#fff; font-size:21px; font-weight:700; margin:0 0 6px;}
        .flow p.sub{color:#9FB6D9; font-size:13.5px; margin:0 0 28px;}
        .flow-steps{display:grid; grid-template-columns:repeat(4,1fr); gap:14px;}
        .flow-step{background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.1); border-radius:13px; padding:20px;}
        .flow-num{width:30px; height:30px; border-radius:50%; background:var(--blue-accent); color:#fff; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:700; margin-bottom:14px;}
        .flow-step p{font-size:13px; color:#E8F2EA; margin:0; line-height:1.5;}
        .howto{padding:56px 64px; background:#fff;}
        .howto-list{display:flex; flex-direction:column; gap:0;}
        .howto-item{display:flex; gap:22px; padding:26px 0; border-bottom:1px solid #E3E8EF;}
        .howto-item:last-child{border-bottom:none;}
        .howto-num{width:46px; height:46px; min-width:46px; border-radius:12px; background:#E8F0FC; color:#1B4F8C; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700;}
        .howto-body h3{font-size:15.5px; font-weight:700; margin:0 0 6px; color:var(--navy-900); display:flex; align-items:center; gap:8px;}
        .howto-body h3 i{font-size:17px; color:var(--blue-accent);}
        .howto-body p{font-size:13.5px; color:#5B6478; margin:0 0 8px; line-height:1.6; max-width:560px;}
        .howto-note{display:inline-flex; align-items:center; gap:6px; font-size:12px; color:#854F0B; background:#FAEEDA; padding:5px 12px; border-radius:7px;}
        .howto-note.ok{color:#1E7B34; background:#E6F4EA;}
        .howto-cta{margin-top:30px; background:#F4F6FA; border-radius:14px; padding:22px 26px; display:flex; align-items:center; justify-content:space-between;}
        .howto-cta p{margin:0; font-size:13.5px; color:#5B6478;}
        .howto-cta strong{display:block; font-size:15px; color:var(--navy-900); margin-bottom:3px;}
        .foot{text-align:center; padding:22px; font-size:12px; color:#8A92A3; background:#fff; border-top:1px solid #E3E8EF;}
    </style>
</head>
<body>
    <div class="nav">
        <div class="brand">
            <div class="brand-mark"><i class="ti ti-building-bank"></i></div>
            <div class="brand-text">E-Lapor Sumberarum<span>Kalurahan Sumberarum</span></div>
        </div>
        <div class="nav-links">
            <a href="{{ route('admin.login') }}" class="nav-btn">Admin</a>
            <a href="{{ route('petugas.login') }}" class="nav-btn">Petugas</a>
            <a href="{{ route('warga.login') }}" class="nav-btn solid">Masuk Warga</a>
        </div>
    </div>

    <div class="hero">
        <div class="eyebrow"><i class="ti ti-shield-check"></i> Layanan resmi Kalurahan Sumberarum</div>
        <h1>Sampaikan keluhan warga, kami tindaklanjuti dengan cepat</h1>
        <p>Laporkan jalan rusak, lampu mati, hingga keluhan administrasi langsung dari rumah. Transparan dan bisa dipantau statusnya kapan saja.</p>
        <div class="hero-actions">
            <a href="{{ route('warga.register') }}" class="btn-primary">Buat laporan <i class="ti ti-arrow-right"></i></a>
            <a href="{{ route('warga.login') }}" class="btn-secondary">Lacak status laporan</a>
        </div>
        <div class="stats">
            <div class="stat"><div class="num">1.284</div><div class="label">Warga terdaftar</div></div>
            <div class="stat"><div class="num">312</div><div class="label">Laporan selesai</div></div>
            <div class="stat"><div class="num">2 hari</div><div class="label">Rata-rata respon</div></div>
        </div>
    </div>

    <div class="section">
        <div class="section-head">
            <h2>Kategori pengaduan yang sering dilaporkan</h2>
            <p>Pilih kategori yang sesuai saat membuat laporan</p>
        </div>
        <div class="cat-grid">
            <div class="cat-card">
                <div class="cat-icon ic-rusak"><i class="ti ti-road"></i></div>
                <h3>Jalan rusak</h3>
                <p>Lubang, retak, atau kerusakan jalan di lingkungan warga</p>
            </div>
            <div class="cat-card">
                <div class="cat-icon ic-lampu"><i class="ti ti-bulb"></i></div>
                <h3>Lampu jalan mati</h3>
                <p>Penerangan jalan umum yang tidak berfungsi</p>
            </div>
            <div class="cat-card">
                <div class="cat-icon ic-sampah"><i class="ti ti-trash"></i></div>
                <h3>Sampah menumpuk</h3>
                <p>Penumpukan sampah yang belum terangkut petugas</p>
            </div>
            <div class="cat-card">
                <div class="cat-icon ic-air"><i class="ti ti-droplet"></i></div>
                <h3>Saluran air tersumbat</h3>
                <p>Got atau drainase yang berisiko menyebabkan banjir</p>
            </div>
        </div>
    </div>

    <div class="howto" id="cara-lapor">
        <div class="section-head">
            <h2>Cara melapor</h2>
            <p>Panduan lengkap mengirim pengaduan, dari registrasi sampai laporan selesai ditangani</p>
        </div>
        <div class="howto-list">
            <div class="howto-item">
                <div class="howto-num">1</div>
                <div class="howto-body">
                    <h3><i class="ti ti-user-plus"></i> Daftar akun warga</h3>
                    <p>Klik tombol "Masuk / Daftar" lalu pilih "Daftar di sini". Isi data sesuai KTP dan Kartu Keluarga: NIK, Nomor KK, nama, alamat, RT/RW, email, nomor HP, dan buat password.</p>
                    <span class="howto-note"><i class="ti ti-alert-triangle"></i> Gunakan data asli, NIK dan No KK akan dicek oleh admin</span>
                </div>
            </div>
            <div class="howto-item">
                <div class="howto-num">2</div>
                <div class="howto-body">
                    <h3><i class="ti ti-clock-hour-4"></i> Tunggu verifikasi admin</h3>
                    <p>Setelah daftar, admin kelurahan akan memeriksa kecocokan data kependudukan kamu. Proses ini biasanya selesai dalam 1&ndash;2 hari kerja.</p>
                    <span class="howto-note ok"><i class="ti ti-bell"></i> Kamu bisa cek status dengan mencoba login secara berkala</span>
                </div>
            </div>
            <div class="howto-item">
                <div class="howto-num">3</div>
                <div class="howto-body">
                    <h3><i class="ti ti-login-2"></i> Login ke dashboard warga</h3>
                    <p>Jika akun sudah terverifikasi, masuk menggunakan email dan password yang kamu daftarkan. Kamu akan diarahkan ke dashboard warga.</p>
                </div>
            </div>
            <div class="howto-item">
                <div class="howto-num">4</div>
                <div class="howto-body">
                    <h3><i class="ti ti-edit"></i> Isi formulir pengaduan</h3>
                    <p>Klik "Buat pengaduan", lalu lengkapi judul, kategori (jalan rusak, lampu mati, sampah, dll), lokasi kejadian, dan jelaskan keluhan secara detail. Lampirkan foto bukti jika ada.</p>
                </div>
            </div>
            <div class="howto-item">
                <div class="howto-num">5</div>
                <div class="howto-body">
                    <h3><i class="ti ti-clipboard-check"></i> Admin memvalidasi laporan</h3>
                    <p>Admin kelurahan meninjau laporanmu, lalu menugaskannya ke petugas lapangan yang sesuai untuk ditindaklanjuti.</p>
                </div>
            </div>
            <div class="howto-item">
                <div class="howto-num">6</div>
                <div class="howto-body">
                    <h3><i class="ti ti-tool"></i> Petugas menindaklanjuti</h3>
                    <p>Petugas yang ditugaskan akan menangani laporan di lapangan dan memberi tanggapan tertulis pada setiap perkembangan.</p>
                </div>
            </div>
            <div class="howto-item">
                <div class="howto-num">7</div>
                <div class="howto-body">
                    <h3><i class="ti ti-circle-check"></i> Pantau status & hasil</h3>
                    <p>Buka kembali dashboard warga kapan saja untuk melihat status terbaru: Menunggu, Diverifikasi, Diproses, Selesai, atau Ditolak &mdash; lengkap dengan tanggapan dari petugas.</p>
                </div>
            </div>
        </div>
        <div class="howto-cta">
            <p><strong>Siap membuat laporan?</strong>Daftar sekarang, prosesnya hanya butuh beberapa menit</p>
            <a href="{{ route('warga.register') }}" class="btn-primary">Daftar sekarang <i class="ti ti-arrow-right"></i></a>
        </div>
    </div>

    <div class="flow">
        <h2>Ringkasan alur</h2>
        <p class="sub">Empat langkah inti dari laporan hingga selesai ditangani</p>
        <div class="flow-steps">
            <div class="flow-step"><div class="flow-num">1</div><p>Warga daftar menggunakan NIK & Nomor KK</p></div>
            <div class="flow-step"><div class="flow-num">2</div><p>Admin kelurahan memverifikasi data warga</p></div>
            <div class="flow-step"><div class="flow-num">3</div><p>Warga mengirim laporan pengaduan</p></div>
            <div class="flow-step"><div class="flow-num">4</div><p>Petugas menindaklanjuti & update status</p></div>
        </div>
    </div>

    <div class="foot">&copy; 2026 Pemerintah Kalurahan Sumberarum &mdash; Layanan Pengaduan Digital</div>
</body>
</html>
