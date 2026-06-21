@extends('layouts.app')

@section('page-title', 'Buat pengaduan')
@section('page-sub', 'Lengkapi formulir berikut dengan detail yang jelas')
@section('logout-route', route('warga.logout'))
@section('user-initial', strtoupper(substr($warga->nama ?? Auth::guard('warga')->user()->nama,0,1)))
@section('user-name', Auth::guard('warga')->user()->nama)
@section('user-role', 'Warga')

@section('sidebar')
<a href="{{ route('warga.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('warga.pengaduan.buat') }}" class="side-link active"><i class="ti ti-circle-plus"></i> Buat pengaduan</a>
@endsection

@section('content')
<div class="card" style="max-width:680px;">
    <div class="card-head"><h2>Formulir pengaduan baru</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ route('warga.pengaduan.simpan') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Judul pengaduan</label>
                <input type="text" name="judul" class="form-control" placeholder="Contoh: Jalan berlubang di depan RT 03" value="{{ old('judul') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    <option value="jalan rusak" {{ old('kategori')=='jalan rusak'?'selected':'' }}>Jalan rusak</option>
                    <option value="lampu jalan" {{ old('kategori')=='lampu jalan'?'selected':'' }}>Lampu jalan</option>
                    <option value="sampah" {{ old('kategori')=='sampah'?'selected':'' }}>Sampah</option>
                    <option value="administrasi" {{ old('kategori')=='administrasi'?'selected':'' }}>Administrasi</option>
                    <option value="saluran air" {{ old('kategori')=='saluran air'?'selected':'' }}>Saluran air</option>
                    <option value="surat menyurat" {{ old('kategori')=='surat menyurat'?'selected':'' }}>Surat menyurat</option>
                    <option value="lainnya" {{ old('kategori')=='lainnya'?'selected':'' }}>Lainnya</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Lokasi kejadian</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Jl. Mawar No.5, RT 03/RW 02" value="{{ old('lokasi') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Isi pengaduan</label>
                <textarea name="isi_pengaduan" class="form-control" rows="5" placeholder="Jelaskan pengaduan kamu secara detail..." required>{{ old('isi_pengaduan') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Foto bukti (opsional, maks 2MB)</label>
                <input type="file" name="foto_bukti" class="form-control" accept="image/jpg,image/jpeg,image/png">
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="ti ti-send"></i> Kirim pengaduan</button>
                <a href="{{ route('warga.dashboard') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
