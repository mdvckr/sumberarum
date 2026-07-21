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
                Tidak ada warga yang ditemukan
            </div>
        </td>
    </tr>
@endforelse
