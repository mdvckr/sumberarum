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

<style>
/* Modal foto */
#foto-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.75);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(6px);
    animation: fadeIn .2s ease;
}
#foto-modal.open { display: flex; }
#foto-modal img {
    max-width: 90vw;
    max-height: 85vh;
    border-radius: 12px;
    box-shadow: 0 24px 80px rgba(0,0,0,.5);
    object-fit: contain;
    animation: zoomIn .25s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.modal-close {
    position: absolute;
    top: 20px;
    right: 24px;
    background: rgba(255,255,255,.15);
    border: none;
    color: #fff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
}
.modal-close:hover { background: rgba(255,255,255,.3); }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes zoomIn { from { transform:scale(.88); opacity:0; } to { transform:scale(1); opacity:1; } }

.btn-foto {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 16px;
    background: #E8F0FC;
    color: #1B4F8C;
    border: 1px solid #BFD7FF;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .25s ease;
    text-decoration: none;
}
.btn-foto:hover {
    background: #1B4F8C;
    color: #fff;
    border-color: #1B4F8C;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(27,79,140,.25);
}

/* Catatan admin */
.catatan-box {
    background: #EFF6FF;
    border: 1px solid #BFD7FF;
    border-left: 4px solid #2E7BE0;
    border-radius: 10px;
    padding: 14px 16px;
    font-size: 13.5px;
    line-height: 1.7;
    color: #1B4F8C;
    margin-top: 12px;
}
.catatan-box .cat-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #2E7BE0;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
}
</style>

<a href="{{ route('petugas.pengaduan.index') }}" class="btn btn-outline btn-sm" style="margin-bottom:16px;">
    <i class="ti ti-arrow-left"></i> Kembali
</a>

@if(session('success'))
<div style="background:#E6F4EA; color:#1E7B34; padding:12px 16px; border-radius:9px; margin-bottom:14px; font-size:13.5px; display:flex; align-items:center; gap:8px;">
    <i class="ti ti-circle-check"></i> {{ session('success') }}
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 320px; gap:18px; align-items:start;">

    {{-- Kolom kiri: detail laporan --}}
    <div>
        <div class="card" style="margin-bottom:18px;">
            <div class="card-head"><h2>Detail laporan</h2></div>
            <div class="card-body">
                <div style="display:grid; grid-template-columns:130px 1fr; row-gap:13px; font-size:13.5px;">
                    <div style="color:var(--text-3);">Pelapor</div>
                    <div style="font-weight:600;">{{ $pengaduan->warga->nama ?? '-' }}</div>

                    <div style="color:var(--text-3);">NIK</div>
                    <div>{{ $pengaduan->warga->nik ?? '-' }}</div>

                    <div style="color:var(--text-3);">Judul</div>
                    <div>{{ $pengaduan->judul }}</div>

                    <div style="color:var(--text-3);">Kategori</div>
                    <div><span class="badge badge-neutral">{{ ucfirst($pengaduan->kategori) }}</span></div>

                    <div style="color:var(--text-3);">Lokasi</div>
                    <div>{{ $pengaduan->lokasi }}</div>

                    <div style="color:var(--text-3);">Tanggal</div>
                    <div>{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>

                    <div style="color:var(--text-3);">Status</div>
                    <div>
                        @php
                            $sc = match($pengaduan->status ?? '') {
                                'diverifikasi' => '#1E7B34', 'ditolak' => '#B23A3A',
                                'selesai'      => '#1B4F8C', 'diproses' => '#854F0B',
                                default        => '#854F0B',
                            };
                            $sb = match($pengaduan->status ?? '') {
                                'diverifikasi' => '#E6F4EA', 'ditolak' => '#FCEAEA',
                                'selesai'      => '#E8F0FC', 'diproses' => '#FFF4E6',
                                default        => '#FFF4E6',
                            };
                        @endphp
                        <span style="background:{{ $sb }}; color:{{ $sc }}; padding:3px 10px; border-radius:6px; font-size:12px; font-weight:600;">
                            {{ ucfirst($pengaduan->status ?? 'Menunggu') }}
                        </span>
                    </div>

                    <div style="color:var(--text-3); align-self:start; padding-top:2px;">Isi pengaduan</div>
                    <div style="line-height:1.6;">{{ $pengaduan->isi_pengaduan }}</div>

                    @if($pengaduan->foto_bukti)
                    <div style="color:var(--text-3); align-self:center;">Foto bukti</div>
                    <div>
                        <button class="btn-foto" onclick="openFoto('{{ asset('storage/'.$pengaduan->foto_bukti) }}')">
                            <i class="ti ti-photo"></i> Lihat Foto Bukti
                        </button>
                    </div>
                    @else
                    <div style="color:var(--text-3);">Foto bukti</div>
                    <div style="color:#aaa; font-style:italic;">Tidak ada foto</div>
                    @endif
                </div>

                {{-- Catatan dari admin --}}
                @if($pengaduan->catatan_admin)
                <div class="catatan-box">
                    <div class="cat-label"><i class="ti ti-notes"></i> Catatan dari admin</div>
                    {{ $pengaduan->catatan_admin }}
                </div>
                @endif
            </div>
        </div>

        {{-- Riwayat tanggapan --}}
        <div class="card">
            <div class="card-head"><h2>Riwayat tanggapan</h2></div>
            <div class="card-body">
                @forelse($pengaduan->tanggapans as $t)
                <div style="border:1px solid var(--border-c); border-radius:10px; padding:13px 16px; margin-bottom:10px;">
                    <div style="display:flex; justify-content:space-between; font-size:13px;">
                        <strong>{{ $t->petugas->nama_petugas ?? 'Petugas' }}</strong>
                        <span style="color:var(--text-3);">{{ \Carbon\Carbon::parse($t->tanggal_tanggapan)->format('d M Y, H:i') }}</span>
                    </div>
                    <p style="margin:6px 0 0; font-size:13px; color:var(--text-2); line-height:1.6;">{{ $t->isi_tanggapan }}</p>
                </div>
                @empty
                <div class="empty-state">Belum ada tanggapan.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Kolom kanan: form tanggapan --}}
    <div>
        @if($pengaduan->status != 'selesai')
        <div class="card">
            <div class="card-head"><h2>Beri tanggapan</h2></div>
            <div class="card-body">
                <form method="POST" action="{{ route('petugas.pengaduan.tanggapi', $pengaduan->id_pengaduan) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Isi tanggapan</label>
                        <textarea name="isi_tanggapan" class="form-control" rows="5"
                            placeholder="Tuliskan tindakan yang sudah/akan dilakukan..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Update status</label>
                        <select name="status" class="form-select" required>
                            <option value="diproses" {{ ($pengaduan->status ?? '')==='diproses'?'selected':'' }}>Sedang diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="ti ti-send"></i> Kirim tanggapan
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body" style="display:flex; flex-direction:column; gap:16px;">
                <span class="badge badge-ok" style="padding:10px 16px; font-size:13px; align-self:flex-start;">
                    <i class="ti ti-circle-check"></i> Pengaduan sudah selesai ditangani
                </span>
                @if($pengaduan->warga && $pengaduan->warga->no_hp)
                    @php
                        $phone = $pengaduan->warga->no_hp;
                        if(substr($phone, 0, 1) == '0') {
                            $phone = '62' . substr($phone, 1);
                        }
                        $message = urlencode("Halo, kami dari petugas Kalurahan Sumberarum ingin menginformasikan bahwa pengaduan Anda dengan judul '{$pengaduan->judul}' telah selesai ditangani.");
                    @endphp
                    <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank" class="btn btn-success" style="align-self:flex-start; background-color:#25D366; color:#fff; border:none; padding:10px 16px; font-size:13px;">
                        <i class="ti ti-brand-whatsapp" style="font-size:18px;"></i> Kirim WhatsApp ke Pelapor
                    </a>
                @endif
            </div>
        </div>
        @endif
    </div>

</div>

{{-- Modal foto --}}
<div id="foto-modal" onclick="closeFoto(event)">
    <button class="modal-close" onclick="closeFotoBtn()">
        <i class="ti ti-x"></i>
    </button>
    <img id="foto-modal-img" src="" alt="Foto bukti">
</div>

<script>
function openFoto(src) {
    document.getElementById('foto-modal-img').src = src;
    document.getElementById('foto-modal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeFotoBtn() {
    document.getElementById('foto-modal').classList.remove('open');
    document.body.style.overflow = '';
}
function closeFoto(e) {
    if (e.target === document.getElementById('foto-modal')) closeFotoBtn();
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeFotoBtn();
});
</script>

@endsection
