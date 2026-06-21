@extends('layouts.app')

@section('page-title', 'Pengaduan saya')
@section('page-sub', 'Semua laporan yang ditugaskan kepada kamu')
@section('logout-route', route('petugas.logout'))
@section('user-initial', strtoupper(substr(Auth::guard('petugas')->user()->nama_petugas,0,1)))
@section('user-name', Auth::guard('petugas')->user()->nama_petugas)
@section('user-role', Auth::guard('petugas')->user()->jabatan)

@section('sidebar')
<a href="{{ route('petugas.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('petugas.pengaduan.index') }}" class="side-link active"><i class="ti ti-clipboard-list"></i> Pengaduan saya</a>
@endsection

@section('content')
<div class="card">
    <div class="card-head"><h2>Semua pengaduan ditugaskan</h2></div>
    <table>
        <thead><tr><th>Warga</th><th>Judul</th><th>Kategori</th><th>Lokasi</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @forelse($pengaduans as $p)
            <tr>
                <td>{{ $p->warga->nama ?? '-' }}</td>
                <td>{{ $p->judul }}</td>
                <td><span class="badge badge-neutral">{{ ucfirst($p->kategori) }}</span></td>
                <td>{{ $p->lokasi }}</td>
                <td>
                    @if($p->status == 'diverifikasi')<span class="badge badge-info">Diverifikasi</span>
                    @elseif($p->status == 'diproses')<span class="badge badge-info">Diproses</span>
                    @elseif($p->status == 'selesai')<span class="badge badge-ok">Selesai</span>
                    @else<span class="badge badge-warn">{{ ucfirst($p->status) }}</span>@endif
                </td>
                <td><a href="{{ route('petugas.pengaduan.detail', $p->id_pengaduan) }}" class="btn btn-outline btn-sm">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="6"><div class="empty-state">Belum ada pengaduan ditugaskan</div></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
