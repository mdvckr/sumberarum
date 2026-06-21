@extends('layouts.app')

@section('page-title', 'Detail pengaduan')
@section('page-sub', $pengaduan->judul)
@section('logout-route', route('petugas.logout'))
@section('user-initial', strtoupper(substr(Auth::guard('petugas')->user()->nama_petugas,0,1)))
@section('user-name', Auth::guard('petugas')->user()->nama_petugas)
@section('user-role', Auth::guard('petugas')->user()->jabatan)

@section('sidebar')
<a href="{{ route('petugas.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('petugas.pengaduan.index') }}" class="side-link active"><i class="ti ti-clipboard-list"></i> Pengaduan saya</a>
@endsection

@section('content')
<a href="{{ route('petugas.pengaduan.index') }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;"><i class="ti ti-arrow-left"></i> Kembali</a>

<div style="display:grid; grid-template-columns:1fr 320px; gap:18px; align-items:start;">
    <div>
        <div class="card" style="margin-bottom:18px;">
            <div class="card-head"><h2>Detail laporan</h2></div>
            <div class="card-body">
                <div style="display:grid; grid-template-columns:130px 1fr; row-gap:12px; font-size:13.5px;">
                    <div style="color:var(--text-3);">Pelapor</div><div style="font-weight:600;">{{ $pengaduan->warga->nama ?? '-' }}</div>
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
            <div class="card-head"><h2>Riwayat tanggapan</h2></div>
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
                <div class="empty-state">Belum ada tanggapan.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div>
        @if($pengaduan->status != 'selesai')
        <div class="card">
            <div class="card-head"><h2>Beri tanggapan</h2></div>
            <div class="card-body">
                <form method="POST" action="{{ route('petugas.pengaduan.tanggapi', $pengaduan->id_pengaduan) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Isi tanggapan</label>
                        <textarea name="isi_tanggapan" class="form-control" rows="4" placeholder="Tuliskan tindakan yang sudah/akan dilakukan..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Update status</label>
                        <select name="status" class="form-select" required>
                            <option value="diproses">Sedang diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;"><i class="ti ti-send"></i> Kirim tanggapan</button>
                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <span class="badge badge-ok"><i class="ti ti-circle-check"></i> Pengaduan sudah selesai ditangani</span>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
