@extends('layouts.app')

@section('page-title', 'Kelola pengaduan')
@section('page-sub', 'Validasi dan tugaskan laporan ke petugas')
@section('logout-route', route('admin.logout'))
@section('user-initial', 'A')
@section('user-name', Auth::guard('admin')->user()->nama_admin)
@section('user-role', 'Admin kelurahan')

@section('sidebar')
<a href="{{ route('admin.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('admin.verifikasi.index') }}" class="side-link"><i class="ti ti-user-check"></i> Verifikasi warga</a>
<a href="{{ route('admin.pengaduan.index') }}" class="side-link active"><i class="ti ti-clipboard-list"></i> Kelola pengaduan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-head"><h2>Semua pengaduan</h2></div>
    <table>
        <thead><tr><th>Warga</th><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse($pengaduans as $p)
            <tr>
                <td>{{ $p->warga->nama ?? '-' }}</td>
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
                <td><a href="{{ route('admin.pengaduan.detail', $p->id_pengaduan) }}" class="btn btn-outline btn-sm">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="6"><div class="empty-state">Belum ada pengaduan</div></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
