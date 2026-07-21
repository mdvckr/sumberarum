@extends('layouts.app')

@section('page-title', 'Kelola Pengguna')
@section('page-sub', 'Manajemen data warga dan petugas kelurahan')
@section('logout-route', route('admin.logout'))
@section('user-initial', 'A')
@section('user-name', Auth::guard('admin')->user()->nama_admin)
@section('user-role', 'Admin kelurahan')

@section('sidebar')
<a href="{{ route('admin.dashboard') }}" class="side-link"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
<a href="{{ route('admin.verifikasi.index') }}" class="side-link"><i class="ti ti-user-check"></i> Verifikasi warga</a>
<a href="{{ route('admin.pengaduan.index') }}" class="side-link"><i class="ti ti-clipboard-list"></i> Kelola pengaduan</a>
<a href="{{ route('admin.users.index') }}" class="side-link active"><i class="ti ti-users"></i> Kelola Pengguna</a>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-head d-flex justify-content-between align-items-center">
        <ul class="nav nav-pills" id="userTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="warga-tab" data-bs-toggle="tab" data-bs-target="#warga" type="button" role="tab">Data Warga</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="petugas-tab" data-bs-toggle="tab" data-bs-target="#petugas" type="button" role="tab">Data Petugas</button>
            </li>
        </ul>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahWarga" id="btnTambahWarga">Tambah Warga</button>
            <button class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalTambahPetugas" id="btnTambahPetugas">Tambah Petugas</button>
        </div>
    </div>
    
    <div class="card-body">
        <div class="tab-content" id="userTabsContent">
            <!-- Tab Warga -->
            <div class="tab-pane fade show active" id="warga" role="tabpanel" tabindex="0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wargas as $w)
                            <tr id="row-warga-{{ $w->id_warga }}">
                                <td>{{ $w->nik }}</td>
                                <td>{{ $w->nama }}</td>
                                <td>{{ $w->no_hp }}</td>
                                <td>
                                    <span class="badge @if($w->status_verifikasi=='terverifikasi') bg-success @elseif($w->status_verifikasi=='ditolak') bg-danger @else bg-warning text-dark @endif">
                                        {{ ucfirst($w->status_verifikasi) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditWarga{{ $w->id_warga }}">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusUser('{{ route('admin.users.warga.destroy', $w->id_warga) }}', 'warga-{{ $w->id_warga }}')">Hapus</button>
                                </td>
                            </tr>
                            
                            <!-- Modal Edit Warga -->
                            <div class="modal fade" id="modalEditWarga{{ $w->id_warga }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.users.warga.update', $w->id_warga) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Warga</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>NIK</label>
                                                    <input type="text" name="nik" class="form-control" value="{{ $w->nik }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>No KK</label>
                                                    <input type="text" name="no_kk" class="form-control" value="{{ $w->no_kk }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control" value="{{ $w->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $w->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password (Kosongkan jika tidak diubah)</label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" value="{{ $w->alamat }}" required>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col"><label>RT</label><input type="text" name="rt" class="form-control" value="{{ $w->rt }}" required></div>
                                                    <div class="col"><label>RW</label><input type="text" name="rw" class="form-control" value="{{ $w->rw }}" required></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>No HP</label>
                                                    <input type="text" name="no_hp" class="form-control" value="{{ $w->no_hp }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Status Verifikasi</label>
                                                    <select name="status_verifikasi" class="form-select">
                                                        <option value="menunggu" @if($w->status_verifikasi=='menunggu') selected @endif>Menunggu</option>
                                                        <option value="terverifikasi" @if($w->status_verifikasi=='terverifikasi') selected @endif>Terverifikasi</option>
                                                        <option value="ditolak" @if($w->status_verifikasi=='ditolak') selected @endif>Ditolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Tab Petugas -->
            <div class="tab-pane fade" id="petugas" role="tabpanel" tabindex="0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Username</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas as $p)
                            <tr id="row-petugas-{{ $p->id_petugas }}">
                                <td>{{ $p->nama_petugas }}</td>
                                <td>{{ $p->username }}</td>
                                <td>{{ $p->jabatan }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditPetugas{{ $p->id_petugas }}">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusUser('{{ route('admin.users.petugas.destroy', $p->id_petugas) }}', 'petugas-{{ $p->id_petugas }}')">Hapus</button>
                                </td>
                            </tr>
                            
                            <!-- Modal Edit Petugas -->
                            <div class="modal fade" id="modalEditPetugas{{ $p->id_petugas }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.users.petugas.update', $p->id_petugas) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Petugas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Nama Petugas</label>
                                                    <input type="text" name="nama_petugas" class="form-control" value="{{ $p->nama_petugas }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control" value="{{ $p->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Password (Kosongkan jika tidak diubah)</label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jabatan</label>
                                                    <input type="text" name="jabatan" class="form-control" value="{{ $p->jabatan }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>No HP</label>
                                                    <input type="text" name="no_hp" class="form-control" value="{{ $p->no_hp }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Warga -->
<div class="modal fade" id="modalTambahWarga" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.users.warga.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>NIK</label><input type="text" name="nik" class="form-control" required></div>
                    <div class="mb-3"><label>No KK</label><input type="text" name="no_kk" class="form-control" required></div>
                    <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label>Alamat</label><input type="text" name="alamat" class="form-control" required></div>
                    <div class="row mb-3">
                        <div class="col"><label>RT</label><input type="text" name="rt" class="form-control" required></div>
                        <div class="col"><label>RW</label><input type="text" name="rw" class="form-control" required></div>
                    </div>
                    <div class="mb-3"><label>No HP</label><input type="text" name="no_hp" class="form-control" required></div>
                    <div class="mb-3"><label>Status Verifikasi</label>
                        <select name="status_verifikasi" class="form-select">
                            <option value="menunggu">Menunggu</option>
                            <option value="terverifikasi" selected>Terverifikasi</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Petugas -->
<div class="modal fade" id="modalTambahPetugas" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.users.petugas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>Nama Petugas</label><input type="text" name="nama_petugas" class="form-control" required></div>
                    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" required></div>
                    <div class="mb-3"><label>No HP</label><input type="text" name="no_hp" class="form-control" required></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('warga-tab').addEventListener('shown.bs.tab', function () {
        document.getElementById('btnTambahWarga').classList.remove('d-none');
        document.getElementById('btnTambahPetugas').classList.add('d-none');
    });
    document.getElementById('petugas-tab').addEventListener('shown.bs.tab', function () {
        document.getElementById('btnTambahPetugas').classList.remove('d-none');
        document.getElementById('btnTambahWarga').classList.add('d-none');
    });

    function hapusUser(url, rowId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        document.getElementById('row-'+rowId).remove();
                        Swal.fire('Terhapus!', data.message, 'success');
                    } else {
                        Swal.fire('Gagal!', 'Data gagal dihapus', 'error');
                    }
                });
            }
        });
    }
</script>
@endsection
