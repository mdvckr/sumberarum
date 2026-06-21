@extends('layouts.app')

@section('page-title', 'Detail pengaduan')
@section('page-sub', $pengaduan->judul)
@section('logout-route', route('warga.logout'))
@section('user-initial', strtoupper(substr(Auth::guard('warga')->user()->nama,0,1)))
@section('user-name', Auth::guard('warga')->user()->nama)
@section('user-role', 'Warga')

@section('sidebar')
<a href="{{ route('warga.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('warga.pengaduan.buat') }}" class="side-link"><i class="ti ti-circle-plus"></i> Buat pengaduan</a>
@endsection

@section('content')
<a href="{{ route('warga.dashboard') }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;"><i class="ti ti-arrow-left"></i> Kembali</a>

<div class="card" style="max-width:680px; margin-bottom:18px;">
    <div class="card-head"><h2>Detail laporan</h2>
        @if($pengaduan->status == 'menunggu')<span class="badge badge-warn">Menunggu</span>
        @elseif($pengaduan->status == 'diverifikasi')<span class="badge badge-info">Diverifikasi</span>
        @elseif($pengaduan->status == 'diproses')<span class="badge badge-info">Diproses</span>
        @elseif($pengaduan->status == 'selesai')<span class="badge badge-ok">Selesai</span>
        @else<span class="badge badge-bad">Ditolak</span>@endif
    </div>
    <div class="card-body">
        <div style="display:grid; grid-template-columns:140px 1fr; row-gap:12px; font-size:13.5px;">
            <div style="color:var(--text-3);">Judul</div><div style="font-weight:600;">{{ $pengaduan->judul }}</div>
            <div style="color:var(--text-3);">Kategori</div><div><span class="badge badge-neutral">{{ ucfirst($pengaduan->kategori) }}</span></div>
            <div style="color:var(--text-3);">Lokasi</div><div>{{ $pengaduan->lokasi }}</div>
            <div style="color:var(--text-3);">Tanggal</div><div>{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>
            <div style="color:var(--text-3);">Isi pengaduan</div><div>{{ $pengaduan->isi_pengaduan }}</div>
            @if($pengaduan->foto_bukti)
            <div style="color:var(--text-3);">Foto bukti</div>
            <div><img src="{{ asset('storage/'.$pengaduan->foto_bukti) }}" style="max-width:280px; border-radius:9px; border:1px solid var(--border-c);"></div>
            @endif
        </div>
    </div>
</div>

<div class="card" style="max-width:680px;">
    <div class="card-head"><h2>Tanggapan petugas</h2></div>
    <div class="card-body">
        @forelse($pengaduan->tanggapans as $t)
        <div style="border:1px solid var(--border-c); border-radius:10px; padding:13px 16px; margin-bottom:10px;">
            <div style="display:flex; justify-content:space-between; font-size:13px;">
                <strong>{{ $t->petugas->nama_petugas ?? 'Petugas' }}</strong>
                <span style="color:var(--text-3);">{{ \Carbon\Carbon::parse($t->tanggal_tanggapan)->format('d M Y') }}</span>
            </div>
            <p style="margin:6px 0 0; font-size:13px; color:var(--text-2);">{{ $t->isi_tanggapan }}</p>
        </div>
        @empty
        <div class="empty-state">Belum ada tanggapan dari petugas.</div>
        @endforelse
    </div>
</div>
@endsection
