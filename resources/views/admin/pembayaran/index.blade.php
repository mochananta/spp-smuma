@extends('admin.dashboardsmuma')
@section('content')
    <style>
        .table-responsive {
            overflow: visible !important;
        }

        .table-responsive .dropdown-menu {
            z-index: 1050;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Pembayaran</h2>
        </div>
        <!-- MODAL Rombel -->
        <div class="card mb-4">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Tahun:</label>
                        <select class="form-select form-select-sm" id="filterTahun">
                            <option value="">Pilih Tahun...</option>
                            @foreach ($tahun_ajaran as $tahun)
                                <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Rombel:</label>
                        <select class="form-select form-select-sm" id="filterRombel">
                            <option value="">Pilih Rombel...</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Search:</label>
                        <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari...">
                    </div>

                    <div class="d-flex gap-1">
                        <button class="btn btn-outline-dark btn-sm">Print</button>
                        <button class="btn btn-outline-dark btn-sm">PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Tahun</th>
                                <th>Opsional</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayarans as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->rombel->rombel }}</td>
                                    <td>{{ $siswa->tahunAjaran?->tahun_ajaran ?? '-' }}</td>
                                    <td>{{ $siswa->opsional }}
                                        <div class="d-flex align-items-center">
                                            <!-- Ikon Info -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icon-tabler-info-circle btn-detail-info"
                                                data-bs-toggle="modal" data-bs-target="#modalInfoPembayaran"
                                                data-id="{{ $siswa->id }}" data-nama="{{ $siswa->nama }}"
                                                data-nis="{{ $siswa->nis ?? '-' }}"
                                                data-rombel="{{ $siswa->rombel->rombel ?? '-' }}"
                                                data-jurusan="{{ $siswa->jurusan->jurusan ?? '-' }}"
                                                data-tahun="{{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}"
                                                data-jk="{{ $siswa->jenis_kelamin ?? '-' }}"
                                                data-alamat="{{ $siswa->alamat ?? '-' }}"
                                                data-hportu="{{ $siswa->nama_ortu ?? '-' }}" style="cursor:pointer;">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                <path d="M12 9h.01" />
                                                <path d="M11 12h1v4h1" />
                                            </svg>

                                            <!-- Ikon Notes -->
                                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                                data-bs-target="#modalTransaksiSiswa{{ $siswa->id }}">

                                                <img width="20" height="20"
                                                    src="https://img.icons8.com/external-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto/64/external-notes-contact-and-communication-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto.png"
                                                    alt="external-notes-contact-and-communication-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto" />

                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                                <path d="M9 7l6 0" />
                                                <path d="M9 11l6 0" />
                                                <path d="M9 15l4 0" />
                                                </svg>
                                            </button>
                                            <!-- Dropdown Aksi -->
                                            <div class="dropdown">
                                                <button class="btn p-0 border-0 bg-transparent d-flex align-items-center"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <circle cx="12" cy="5" r="0.6" />
                                                        <circle cx="12" cy="12" r="0.6" />
                                                        <circle cx="12" cy="19" r="0.6" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-jenis="SPP"
                                                            data-jumlah="150000">SPP</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-jenis="Ujian"
                                                            data-jumlah="100000">Ujian</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info -->
    <div class="modal fade" id="modalInfoPembayaran" tabindex="-1" aria-labelledby="modalInfoPembayaranLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="infoNama"></span></p>
                    <p><strong>NIS:</strong> <span id="infoNis"></span></p>
                    <p><strong>Rombel:</strong> <span id="infoRombel"></span></p>
                    <p><strong>Jurusan:</strong> <span id="infoJurusan"></span></p>
                    <p><strong>Tahun Ajaran:</strong> <span id="infoTahun"></span></p>
                    <p><strong>Jenis Kelamin:</strong> <span id="infoJK"></span></p>
                    <p><strong>Alamat:</strong> <span id="infoAlamat"></span></p>
                    <p><strong>No. HP Orang Tua:</strong> <span id="infoHportu"></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailSiswaModal" tabindex="-1" aria-labelledby="detailSiswaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailSiswaModalLabel">Detail Informasi Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input Pembayaran -->
    <div class="modal fade" id="modalInputPembayaran" tabindex="-1" aria-labelledby="modalInputPembayaranLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form id="formInputPembayaran" method="POST" action="{{ route('pembayaran.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputPembayaranLabel">Input Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="siswa_id" id="inputPembayaranSiswaId" value="">

                        <div class="mb-3">
                            <label class="form-label">Kategori Pembayaran</label>
                            <input type="hidden" name="jenis_pembayaran" id="jenis_pembayaran" required>
                            <p class="form-control-plaintext fw-semibold text-dark mb-0" id="jenisPembayaranLabel">-</p>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah"
                                placeholder="Masukkan jumlah pembayaran" required readonly>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                placeholder="Masukkan keterangan jika ada"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($pembayarans as $siswa)
        <div class="modal fade" id="modalTransaksiSiswa{{ $siswa->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Riwayat Pembayaran - {{ $siswa->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>Total Pembayaran:</strong>
                            Rp{{ number_format($siswa->pembayarans->sum('jumlah'), 0, ',', '.') }}</p>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Pembayaran</th>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($siswa->pembayarans as $pembayaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pembayaran->tagihan->kategoriPembayaran->nama ?? '-' }}</td>
                                            <td>Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') }}
                                            </td>
                                            <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada pembayaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- {{ route('transaksi.cetak', $siswa->id) }} --}}
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" target="_blank">Cetak</a>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.dropdown-menu a').forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const tr = this.closest('tr');
                    const siswaId = tr?.querySelector('.btn-detail-siswa')?.dataset.id || '';

                    const jenis = this.dataset.jenis || 'Pembayaran';
                    const jumlah = this.dataset.jumlah || '';

                    document.getElementById('inputPembayaranSiswaId').value = siswaId;
                    document.getElementById('jenis_pembayaran').value = jenis;
                    document.getElementById('jenisPembayaranLabel').textContent = jenis;
                    document.getElementById('jumlah').value = jumlah;

                    document.getElementById('tanggal_pembayaran').value = '';

                    const modal = new bootstrap.Modal(document.getElementById(
                        'modalInputPembayaran'));
                    modal.show();
                });
            });

            document.getElementById('jumlah').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-detail-info').forEach(function(el) {
                el.addEventListener('click', function() {
                    document.getElementById('infoNama').textContent = this.getAttribute(
                        'data-nama') || '-';
                    document.getElementById('infoNis').textContent = this.getAttribute(
                        'data-nis') || '-';
                    document.getElementById('infoRombel').textContent = this.getAttribute(
                        'data-rombel') || '-';
                    document.getElementById('infoJurusan').textContent = this.getAttribute(
                        'data-jurusan') || '-';
                    document.getElementById('infoTahun').textContent = this.getAttribute(
                        'data-tahun') || '-';
                    document.getElementById('infoJK').textContent = this.getAttribute('data-jk') ||
                        '-';
                    document.getElementById('infoAlamat').textContent = this.getAttribute(
                        'data-alamat') || '-';
                    document.getElementById('infoHportu').textContent = this.getAttribute(
                        'data-hportu') || '-';
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('table tbody tr');

            searchInput.addEventListener('keyup', function() {
                const keyword = this.value.toLowerCase();

                tableRows.forEach(function(row) {
                    const rowText = row.innerText.toLowerCase();
                    if (rowText.includes(keyword)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
