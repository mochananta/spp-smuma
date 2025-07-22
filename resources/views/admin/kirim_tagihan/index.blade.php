@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Kirim Tagihan</h2>
        </div>

        <form method="POST" action="{{ route('kirim_tagihan.store') }}">
            @csrf

            <!-- Filter & Tombol -->
            <div class="card mb-4">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-4 pb-2 pt-3">
                    <i class="fa fa-bell" style="font-size: 18px;"></i>
                    <span>Dipilih</span>
                    <span id="jumlahTerpilih" class="badge rounded"
                        style="background-color: #a8f5a2; color: black; font-size: 14px;">0</span>
                    <button type="submit" class="btn btn-sm d-flex align-items-center"
                        style="background-color: #d1e7ff; color: #003366;">
                        <i class="fa fa-paper-plane me-1"></i> Kirim Tagihan
                    </button>
                </div>

                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="d-flex flex-wrap align-items-center gap-2">

                        <!-- Tahun Ajaran -->
                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Tahun:</label>
                            <select class="form-select form-select-sm" name="tahun_ajaran_id" required>
                                <option value="">Pilih Tahun...</option>
                                @foreach ($tahun_ajaran as $tahun)
                                    <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Rombel -->
                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Rombel:</label>
                            <select class="form-select form-select-sm" id="filterRombel">
                                <option value="">Pilih Rombel...</option>
                                @foreach ($rombels as $rombel)
                                    <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kategori -->
                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Kategori:</label>
                            <select class="form-select form-select-sm" name="kategori_pembayaran_id" required>
                                <option value="">Pilih Kategori...</option>
                                @foreach (\App\Models\KategoriPembayaran::all() as $kategori)
                                    <option value="{{ $kategori->id }}">
                                        {{ $kategori->kategori }} - Rp{{ number_format($kategori->nominal) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Search:</label>
                            <input type="text" class="form-control form-control-sm" id="searchInput"
                                placeholder="Cari...">
                        </div>

                        <!-- Aksi -->
                        <div class="d-flex gap-1">
                            <button class="btn btn-outline-dark btn-sm">Print</button>
                            <button class="btn btn-outline-dark btn-sm">PDF</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Siswa -->
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Tahun</th>
                                    <th>Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{ $siswa->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->rombel->rombel }}</td>
                                        <td>{{ $siswa->tahunAjaran?->tahun_ajaran ?? '-' }}</td>
                                        <td>
                                            @if ($siswa->tagihans->isNotEmpty())
                                                <span class="badge bg-success d-inline-flex align-items-center gap-1">
                                                    <i class="fa fa-check-circle"></i> Sudah Ada
                                                </span>
                                                <button type="button"
                                                    class="btn btn-sm btn-link text-primary p-0 ms-1 mt-n1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail{{ $siswa->id }}">
                                                    <i class="fa fa-info-circle"></i>
                                                </button>
                                            @else
                                                <span class="badge bg-warning text-dark">Belum Ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- MODALS DETAIL TAGIHAN -->
            @foreach ($siswas as $siswa)
                @if ($siswa->tagihans->isNotEmpty())
                    <div class="modal fade" id="modalDetail{{ $siswa->id }}" tabindex="-1"
                        aria-labelledby="modalDetailLabel{{ $siswa->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="modalDetailLabel{{ $siswa->id }}">Detail Tagihan -
                                        {{ $siswa->nama }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Bulan</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa->tagihans as $tagihan)
                                                <tr>
                                                    <td>{{ $tagihan->kategori->kategori ?? '-' }}</td>
                                                    <td>{{ $tagihan->bulan ?? '-' }}</td>
                                                    <td>Rp{{ number_format($tagihan->nominal) }}</td>
                                                    <td>
                                                        @if ($tagihan->status === 'lunas')
                                                            <span class="badge bg-success">Lunas</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark">Belum Lunas</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </form>
    </div>

    <!-- Script Checkbox -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            const jumlahTerpilih = document.getElementById('jumlahTerpilih');

            function updateJumlahTerpilih() {
                jumlahTerpilih.textContent = document.querySelectorAll('input[name="ids[]"]:checked').length;
            }

            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    updateJumlahTerpilih();
                });
            }

            checkboxes.forEach(cb => cb.addEventListener('change', updateJumlahTerpilih));
            updateJumlahTerpilih();
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
