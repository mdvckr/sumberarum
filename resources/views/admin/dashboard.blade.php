@extends('layouts.app')

@section('page-title', 'Dashboard admin')
@section('page-sub', 'Ringkasan layanan pengaduan Kalurahan Sumberarum')
@section('logout-route', route('admin.logout'))
@section('user-initial', 'A')
@section('user-name', Auth::guard('admin')->user()->nama_admin)
@section('user-role', 'Admin kelurahan')

@section('sidebar')
<a href="{{ route('admin.dashboard') }}" class="side-link active"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('admin.verifikasi.index') }}" class="side-link"><i class="ti ti-user-check"></i> Verifikasi warga</a>
<a href="{{ route('admin.pengaduan.index') }}" class="side-link"><i class="ti ti-clipboard-list"></i> Kelola pengaduan</a>
@endsection

@section('content')
<div class="stat-grid">
    <div class="stat-card"><div class="num">{{ $totalWarga }}</div><div class="label">Total warga</div></div>
    <div class="stat-card"><div class="num">{{ $totalPengaduan }}</div><div class="label">Total pengaduan</div></div>
    <div class="stat-card"><div class="num">{{ $menunggu }}</div><div class="label">Menunggu</div></div>
    <div class="stat-card"><div class="num">{{ $diproses }}</div><div class="label">Diproses</div></div>
</div>
<div class="stat-grid" style="grid-template-columns:repeat(2,1fr); max-width:420px;">
    <div class="stat-card"><div class="num">{{ $selesai }}</div><div class="label">Selesai</div></div>
    <div class="stat-card"><div class="num">{{ $ditolak }}</div><div class="label">Ditolak</div></div>
</div>

<div class="card">
    <div class="card-head"><h2>Pengaduan terbaru</h2><a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline btn-sm">Lihat semua</a></div>
    <table>
        <thead><tr><th>Warga</th><th>Judul</th><th>Kategori</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse($terbaru as $p)
            <tr>
                <td>{{ $p->warga->nama ?? '-' }}</td>
                <td>{{ $p->judul }}</td>
                <td><span class="badge badge-neutral">{{ ucfirst($p->kategori) }}</span></td>
                <td>
                    @if($p->status == 'menunggu')<span class="badge badge-warn">Menunggu</span>
                    @elseif($p->status == 'diverifikasi')<span class="badge badge-info">Diverifikasi</span>
                    @elseif($p->status == 'diproses')<span class="badge badge-info">Diproses</span>
                    @elseif($p->status == 'selesai')<span class="badge badge-ok">Selesai</span>
                    @else<span class="badge badge-bad">Ditolak</span>@endif
                </td>
                <td><a href="{{ route('admin.pengaduan.detail', $p->id_pengaduan) }}" class="btn btn-outline btn-sm">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="5"><div class="empty-state">Belum ada pengaduan</div></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
