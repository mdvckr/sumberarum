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
    <div class="card-head">
        <h2>Menunggu verifikasi (<span id="counter-warga">{{ $wargas->count() }}</span>)</h2>
    </div>

    <!-- Container untuk pesan notifikasi opsional -->
    <div id="alert-container" style="padding: 0 16px;"></div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>No KK</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="table-warga-body">
        @forelse($wargas as $w)
            <tr id="row-warga-{{ $w->id_warga }}">
                <td>{{ $w->nama }}</td>
                <td>{{ $w->nik }}</td>
                <td>{{ $w->no_kk }}</td>
                <td>{{ $w->email }}</td>
                <td>RT {{ $w->rt }}/RW {{ $w->rw }}, {{ Str::limit($w->alamat, 30) }}</td>
                <td>
                    <div style="display:flex; gap:6px;">
                        <button type="button" onclick="prosesVerifikasi('{{ $w->id_warga }}', 'terverifikasi')" class="btn btn-success btn-sm">
                            <i class="ti ti-check"></i> Terima
                        </button>
                        <button type="button" onclick="prosesVerifikasi('{{ $w->id_warga }}', 'ditolak')" class="btn btn-danger btn-sm">
                            <i class="ti ti-x"></i> Tolak
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr id="empty-state-row">
                <td colspan="6">
                    <div class="empty-state">
                        <i class="ti ti-user-check" style="font-size:28px; display:block; margin-bottom:8px;"></i>
                        Tidak ada warga yang menunggu verifikasi
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
    function prosesVerifikasi(idWarga, statusNilai) {
        if (!confirm(`Apakah Anda yakin ingin memproses verifikasi ini menjadi "${statusNilai}"?`)) {
            return;
        }

        // Menggunakan helper route() Laravel di dalam JS agar jalur URL dinamis dan aman
        const url = "{{ route('admin.verifikasi.ajax', ':id') }}".replace(':id', idWarga);

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: statusNilai })
        })
        .then(async response => {
            const contentType = response.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                return response.json();
            } else {
                const errorText = await response.text();
                console.error("Server Error HTML:", errorText);
                throw new Error("Server mengembalikan respons bukan JSON. Cek Console F12.");
            }
        })
        .then(data => {
            if (data && data.success) {
                // 1. Hapus baris data dari tabel secara instan
                const row = document.getElementById(`row-warga-${idWarga}`);
                if (row) row.remove();

                // 2. Perbarui angka counter
                const counterElement = document.getElementById('counter-warga');
                if (counterElement) {
                    let currentCount = parseInt(counterElement.innerText) || 1;
                    let newCount = Math.max(0, currentCount - 1);
                    counterElement.innerText = newCount;

                    if (newCount === 0) {
                        document.getElementById('table-warga-body').innerHTML = `
                            <tr id="empty-state-row">
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="ti ti-user-check" style="font-size:28px; display:block; margin-bottom:8px;"></i>
                                        Tidak ada warga yang menunggu verifikasi
                                    </div>
                                </td>
                            </tr>
                        `;
                    }
                }
            } else {
                alert('Gagal memproses verifikasi dari server.');
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
            alert('Terjadi kesalahan koneksi ke server. (Cek F12 Console untuk detail)');
        });
    }
</script>
@endsection