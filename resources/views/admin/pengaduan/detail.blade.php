@extends('layouts.app')

@section('page-title', 'Detail pengaduan')
@section('page-sub', $pengaduan->judul)
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
<a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;"><i class="ti ti-arrow-left"></i> Kembali</a>

<div style="display:grid; grid-template-columns:1fr 320px; gap:18px; align-items:start;">
    <div class="card">
        <div class="card-head"><h2>Detail laporan</h2></div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:130px 1fr; row-gap:12px; font-size:13.5px;">
                <div style="color:var(--text-3);">Pelapor</div><div style="font-weight:600;">{{ $pengaduan->warga->nama ?? '-' }}</div>
                <div style="color:var(--text-3);">NIK</div><div>{{ $pengaduan->warga->nik ?? '-' }}</div>
                <div style="color:var(--text-3);">Judul</div><div>{{ $pengaduan->judul }}</div>
                <div style="color:var(--text-3);">Kategori</div><div><span class="badge badge-neutral">{{ ucfirst($pengaduan->kategori) }}</span></div>
                <div style="color:var(--text-3);">Lokasi</div><div>{{ $pengaduan->lokasi }}</div>
                <div style="color:var(--text-3);">Tanggal</div><div>{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>
                <div style="color:var(--text-3);">Isi pengaduan</div><div>{{ $pengaduan->isi_pengaduan }}</div>
                @if($pengaduan->foto_bukti)
                <div style="color:var(--text-3);">Foto bukti</div>
                <div><img src="{{ asset('storage/'.$pengaduan->foto_bukti) }}" style="max-width:260px; border-radius:9px; border:1px solid var(--border-c);"></div>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-head"><h2>Validasi</h2></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengaduan.validasi', $pengaduan->id_pengaduan) }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Assign ke petugas</label>
                    <select name="id_petugas" class="form-select">
                        <option value="">Pilih petugas</option>
                        @foreach($petugas as $pt)
                        <option value="{{ $pt->id_petugas }}" {{ $pengaduan->id_petugas==$pt->id_petugas?'selected':'' }}>{{ $pt->nama_petugas }} &mdash; {{ $pt->jabatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">Pilih status</option>
                        <option value="diverifikasi">Diverifikasi</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;"><i class="ti ti-circle-check"></i> Simpan validasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
