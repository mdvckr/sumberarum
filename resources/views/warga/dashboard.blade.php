@extends('layouts.app')

@section('page-title', 'Dashboard warga')
@section('page-sub', 'Ringkasan dan riwayat pengaduan kamu')
@section('logout-route', route('warga.logout'))
@section('user-initial', strtoupper(substr($warga->nama,0,1)))
@section('user-name', $warga->nama)
@section('user-role', 'Warga')

@section('sidebar')
<a href="{{ route('warga.dashboard') }}" class="side-link active"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('warga.pengaduan.buat') }}" class="side-link"><i class="ti ti-circle-plus"></i> Buat pengaduan</a>
@endsection

@section('content')
<div style="margin-bottom:20px;">
    <strong style="font-size:15px;">Halo, {{ $warga->nama }}</strong>
    <div style="margin-top:6px;">
        @if($warga->status_verifikasi == 'terverifikasi')
            <span class="badge badge-ok"><i class="ti ti-circle-check"></i> Akun terverifikasi</span>
        @elseif($warga->status_verifikasi == 'menunggu')
            <span class="badge badge-warn"><i class="ti ti-clock"></i> Menunggu verifikasi</span>
        @else
            <span class="badge badge-bad"><i class="ti ti-circle-x"></i> Ditolak</span>
        @endif
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card"><div class="num">{{ $pengaduans->count() }}</div><div class="label">Total pengaduan</div></div>
    <div class="stat-card"><div class="num">{{ $pengaduans->where('status','menunggu')->count() }}</div><div class="label">Menunggu</div></div>
    <div class="stat-card"><div class="num">{{ $pengaduans->where('status','diproses')->count() }}</div><div class="label">Diproses</div></div>
    <div class="stat-card"><div class="num">{{ $pengaduans->where('status','selesai')->count() }}</div><div class="label">Selesai</div></div>
</div>

<div class="card">
    <div class="card-head">
        <h2>Riwayat pengaduan</h2>
        <a href="{{ route('warga.pengaduan.buat') }}" class="btn btn-primary btn-sm"><i class="ti ti-plus"></i> Buat pengaduan</a>
    </div>
    <table>
        <thead><tr><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse($pengaduans as $p)
            <tr>
                <td>{{ $p->judul }}</td>
                <td><span class="badge badge-neutral">{{ ucfirst($p->kategori) }}</span></td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}</td>
                <td>
                    @if($p->status == 'menunggu')<span class="badge badge-warn">Menunggu</span>
                    @elseif($p->status == 'diverifikasi')<span class="badge badge-info">Diverifikasi</span>
                    @elseif($p->status == 'diproses')<span class="badge badge-info">Diproses</span>
                    @elseif($p->status == 'selesai')<span class="badge badge-ok">Selesai</span>
                    @else<span class="badge badge-bad">Ditolak</span>@endif
                </td>
                <td><a href="{{ route('warga.pengaduan.detail', $p->id_pengaduan) }}" class="btn btn-outline btn-sm">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="5"><div class="empty-state"><i class="ti ti-file-off" style="font-size:28px; display:block; margin-bottom:8px;"></i>Belum ada pengaduan</div></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
