@extends('layouts.app')

@section('page-title', 'Dashboard petugas')
@section('page-sub', 'Daftar pengaduan yang ditugaskan kepada kamu')
@section('logout-route', route('petugas.logout'))
@section('user-initial', strtoupper(substr($petugas->nama_petugas,0,1)))
@section('user-name', $petugas->nama_petugas)
@section('user-role', $petugas->jabatan)

@section('sidebar')
<a href="{{ route('petugas.dashboard') }}" class="side-link active"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('petugas.pengaduan.index') }}" class="side-link"><i class="ti ti-clipboard-list"></i> Pengaduan saya</a>
@endsection

@section('content')
<div class="stat-grid" style="grid-template-columns:repeat(3,1fr);">
    <div class="stat-card"><div class="num">{{ $pengaduans->count() }}</div><div class="label">Total ditugaskan</div></div>
    <div class="stat-card"><div class="num">{{ $diproses }}</div><div class="label">Sedang diproses</div></div>
    <div class="stat-card"><div class="num">{{ $selesai }}</div><div class="label">Selesai</div></div>
</div>

<div class="card">
    <div class="card-head"><h2>Pengaduan terbaru</h2><a href="{{ route('petugas.pengaduan.index') }}" class="btn btn-outline btn-sm">Lihat semua</a></div>
    <table>
        <thead><tr><th>Warga</th><th>Judul</th><th>Kategori</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse($pengaduans->take(5) as $p)
            <tr>
                <td>{{ $p->warga->nama ?? '-' }}</td>
                <td>{{ $p->judul }}</td>
                <td><span class="badge badge-neutral">{{ ucfirst($p->kategori) }}</span></td>
                <td>
                    @if($p->status == 'diverifikasi')<span class="badge badge-info">Diverifikasi</span>
                    @elseif($p->status == 'diproses')<span class="badge badge-info">Diproses</span>
                    @elseif($p->status == 'selesai')<span class="badge badge-ok">Selesai</span>
                    @else<span class="badge badge-warn">{{ ucfirst($p->status) }}</span>@endif
                </td>
                <td><a href="{{ route('petugas.pengaduan.detail', $p->id_pengaduan) }}" class="btn btn-outline btn-sm">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="5"><div class="empty-state">Belum ada pengaduan ditugaskan</div></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
