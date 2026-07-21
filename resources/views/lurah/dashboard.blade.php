@extends('layouts.app')

@section('page-title', 'Dashboard Monitoring')
@section('page-sub', 'Pantauan rekapitulasi dan status pengaduan warga')
@section('logout-route', route('lurah.logout'))
@section('user-initial', 'L')
@section('user-name', Auth::guard('lurah')->user()->nama_lurah)
@section('user-role', 'Lurah Sumberarum')

@section('sidebar')
<a href="{{ route('lurah.dashboard') }}" class="side-link active"><i class="ti ti-layout-dashboard"></i> Dashboard Monitoring</a>
@endsection

@section('content')
{{-- Override warna sidebar khusus Lurah --}}
<style>
    .sidebar {
        background: linear-gradient(180deg, #1B1242 0%, #261B54 60%, #392B73 100%) !important;
    }
    .side-link.active {
        background: #5136AA !important;
    }
    .side-user-avatar {
        background: #5136AA !important;
    }
    /* Progress bar kustom */
    .progress-lurah .progress-bar { background: linear-gradient(90deg, #5136AA, #7B5CF0); }
    /* Warna angka stat card lurah */
    .lurah-num { color: #5136AA; }
    /* Indikator titik berwarna */
    .dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 6px; }
    .dot-warn  { background: #ffc107; }
    .dot-info  { background: #0dcaf0; }
    .dot-ok    { background: #198754; }
    .dot-bad   { background: #dc3545; }
</style>

{{-- Stat cards --}}
<div class="stat-grid" style="grid-template-columns: repeat(4,1fr);">
    <div class="stat-card" style="border-top: 3px solid #5136AA;">
        <div class="num lurah-num">{{ $totalPengaduan }}</div>
        <div class="label"><i class="ti ti-clipboard-list" style="color:#5136AA;"></i> Total Pengaduan</div>
    </div>
    <div class="stat-card" style="border-top: 3px solid #ffc107;">
        <div class="num" style="color:#9A6700;">{{ $menunggu }}</div>
        <div class="label"><i class="ti ti-clock" style="color:#ffc107;"></i> Menunggu</div>
    </div>
    <div class="stat-card" style="border-top: 3px solid #0dcaf0;">
        <div class="num" style="color:#1B4F8C;">{{ $diproses }}</div>
        <div class="label"><i class="ti ti-progress" style="color:#0dcaf0;"></i> Diproses</div>
    </div>
    <div class="stat-card" style="border-top: 3px solid #198754;">
        <div class="num" style="color:#1E7B34;">{{ $selesai }}</div>
        <div class="label"><i class="ti ti-circle-check" style="color:#198754;"></i> Selesai</div>
    </div>
</div>

{{-- Chart + Ringkasan --}}
<div class="row mb-4">
    <div class="col-lg-5 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-head">
                <h2 class="mb-0"><i class="ti ti-chart-donut" style="color:#5136AA; margin-right:6px;"></i>Proporsi Status</h2>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center" style="padding: 24px;">
                <canvas id="statusChart" style="max-height: 280px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-head">
                <h2 class="mb-0"><i class="ti ti-report-analytics" style="color:#5136AA; margin-right:6px;"></i>Ringkasan Kinerja</h2>
            </div>
            <div class="card-body" style="padding: 24px;">
                {{-- Tingkat Penyelesaian --}}
                @php
                    $persenSelesai = $totalPengaduan > 0 ? round(($selesai / $totalPengaduan) * 100, 1) : 0;
                    $persenDitolak = $totalPengaduan > 0 ? round(($ditolak / $totalPengaduan) * 100, 1) : 0;
                    $persenProses  = $totalPengaduan > 0 ? round(($diproses / $totalPengaduan) * 100, 1) : 0;
                    $persenMenunggu = $totalPengaduan > 0 ? round(($menunggu / $totalPengaduan) * 100, 1) : 0;
                @endphp

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="dot dot-ok"></span><strong>Selesai</strong></span>
                        <span>{{ $selesai }} laporan ({{ $persenSelesai }}%)</span>
                    </div>
                    <div class="progress progress-lurah" style="height: 10px; border-radius: 8px;">
                        <div class="progress-bar" style="width: {{ $persenSelesai }}%;"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="dot dot-info"></span><strong>Sedang Diproses</strong></span>
                        <span>{{ $diproses }} laporan ({{ $persenProses }}%)</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 8px;">
                        <div class="progress-bar bg-info" style="width: {{ $persenProses }}%;"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="dot dot-warn"></span><strong>Menunggu</strong></span>
                        <span>{{ $menunggu }} laporan ({{ $persenMenunggu }}%)</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 8px;">
                        <div class="progress-bar bg-warning" style="width: {{ $persenMenunggu }}%;"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="dot dot-bad"></span><strong>Ditolak</strong></span>
                        <span>{{ $ditolak }} laporan ({{ $persenDitolak }}%)</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 8px;">
                        <div class="progress-bar bg-danger" style="width: {{ $persenDitolak }}%;"></div>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted" style="font-size: 13px;">Tingkat Penyelesaian Keseluruhan</span>
                    <strong style="font-size: 22px; color: #5136AA;">{{ $persenSelesai }}%</strong>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel semua pengaduan --}}
<div class="card mb-4">
    <div class="card-head">
        <h2 class="mb-0"><i class="ti ti-clipboard-data" style="color:#5136AA; margin-right:6px;"></i>Daftar Semua Pengaduan</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Pelapor (Warga)</th>
                    <th>Judul Laporan</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Petugas Penindak</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($pengaduans as $p)
                <tr>
                    <td>{{ $p->warga->nama ?? '-' }}</td>
                    <td>{{ $p->judul }}</td>
                    <td><span class="badge badge-neutral">{{ ucfirst($p->kategori) }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}</td>
                    <td>{{ $p->petugas->nama_petugas ?? '<span class="text-muted">Belum Ditugaskan</span>' }}</td>
                    <td>
                        @if($p->status == 'menunggu')<span class="badge badge-warn">Menunggu</span>
                        @elseif($p->status == 'diverifikasi')<span class="badge badge-info">Diverifikasi</span>
                        @elseif($p->status == 'diproses')<span class="badge badge-info">Diproses</span>
                        @elseif($p->status == 'selesai')<span class="badge badge-ok">Selesai</span>
                        @else<span class="badge badge-bad">Ditolak</span>@endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4"><div class="empty-state">Belum ada pengaduan tercatat.</div></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'],
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: [{{ $menunggu }}, {{ $diproses }}, {{ $selesai }}, {{ $ditolak }}],
                    backgroundColor: ['#ffc107', '#0dcaf0', '#198754', '#dc3545'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
