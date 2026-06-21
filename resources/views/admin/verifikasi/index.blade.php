@extends('layouts.app')

@section('page-title', 'Verifikasi warga')
@section('page-sub', 'Daftar warga yang menunggu verifikasi data')
@section('logout-route', route('admin.logout'))
@section('user-initial', 'A')
@section('user-name', Auth::guard('admin')->user()->nama_admin)
@section('user-role', 'Admin kelurahan')

@section('sidebar')
<a href="{{ route('admin.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('admin.verifikasi.index') }}" class="side-link active"><i class="ti ti-user-check"></i> Verifikasi warga</a>
<a href="{{ route('admin.pengaduan.index') }}" class="side-link"><i class="ti ti-clipboard-list"></i> Kelola pengaduan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-head"><h2>Menunggu verifikasi ({{ $wargas->count() }})</h2></div>
    <table>
        <thead><tr><th>Nama</th><th>NIK</th><th>No KK</th><th>Email</th><th>Alamat</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($wargas as $w)
            <tr>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->nik }}</td>
                <td>{{ $w->no_kk }}</td>
                <td>{{ $w->email }}</td>
                <td>RT {{ $w->rt }}/RW {{ $w->rw }}, {{ Str::limit($w->alamat, 30) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.verifikasi.proses', $w->id_warga) }}" style="display:flex; gap:6px;">
                        @csrf
                        <button name="status" value="terverifikasi" class="btn btn-success btn-sm"><i class="ti ti-check"></i> Terima</button>
                        <button name="status" value="ditolak" class="btn btn-danger btn-sm"><i class="ti ti-x"></i> Tolak</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6"><div class="empty-state"><i class="ti ti-user-check" style="font-size:28px; display:block; margin-bottom:8px;"></i>Tidak ada warga yang menunggu verifikasi</div></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
