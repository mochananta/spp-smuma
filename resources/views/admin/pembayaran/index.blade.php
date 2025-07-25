@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-4 mb-4">Data Pembayaran Siswa</h4>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pembayaran.index') }}" method="GET" class="card mb-4">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex flex-wrap align-items-center gap-2">

                    {{-- Filter Tahun Ajaran --}}
                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Tahun:</label>
                        <select class="form-select form-select-sm" name="tahun_ajaran_id" required>
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

                    {{-- Button --}}
                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-outline-dark btn-sm">Terapkan</button>
                    </div>
                </div>
            </div>
        </form>


        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Rombel</th>
                            <th>Tahun Ajaran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembayarans as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->rombel->rombel ?? '-' }}</td>
                                <td>{{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                <td class="text-center">
                                    <!-- Tombol Modal Bayar -->
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#bayarModal{{ $siswa->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Input Pembayaran" class="me-2 text-primary">
                                        <i class="fa fa-inbox"></i>
                                    </a>

                                    <a href="#" class="text-info showRiwayatPembayaran" data-id="{{ $siswa->id }}"
                                        data-bs-toggle="modal" data-bs-target="#infoModal" title="Lihat Riwayat Pembayaran">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Input Pembayaran -->
                            <div class="modal fade" id="bayarModal{{ $siswa->id }}" tabindex="-1"
                                aria-labelledby="bayarModalLabel{{ $siswa->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('pembayaran.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pembayaran - {{ $siswa->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                                <input type="hidden" name="tahun_ajaran_id"
                                                    value="{{ $siswa->tahun_ajaran_id }}">

                                                <!-- Input Kategori Pembayaran -->
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori</label>
                                                    <select class="form-select kategori-select"
                                                        name="kategori_pembayaran_id" required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach ($kategoriPembayarans as $kategori)
                                                            <option value="{{ $kategori->id }}"
                                                                data-nominal="{{ $kategori->nominal }}">
                                                                {{ $kategori->kategori }} -
                                                                Rp{{ number_format($kategori->nominal) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <small class="text-muted">* Nominal disesuaikan otomatis berdasarkan
                                                    kategori</small>

                                                <!-- Input Nominal -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nominal</label>
                                                    <input type="number" name="nominal" class="form-control nominal-input"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Bulan</label>
                                                    <select name="bulan" class="form-select" required>
                                                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bln)
                                                            <option value="{{ $bln }}">{{ $bln }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Bayar</label>
                                                    <input type="date" name="tanggal_bayar" class="form-control"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Keterangan</label>
                                                    <textarea name="keterangan" class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Modal Riwayat Pembayaran -->
                <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="infoModalLabel">Riwayat Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body" id="modalRiwayatContent">
                                <p class="text-muted">Memuat data...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('input[name="nominal"]').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tombolInfo = document.querySelectorAll('.showRiwayatPembayaran');
            const modalContent = document.getElementById('modalRiwayatContent');

            tombolInfo.forEach(tombol => {
                tombol.addEventListener('click', function() {
                    const siswaId = this.getAttribute('data-id');
                    modalContent.innerHTML = '<p class="text-muted">Memuat data...</p>';

                    fetch(`/riwayat-pembayaran/${siswaId}`)
                        .then(response => {
                            if (!response.ok) throw new Error("Gagal fetch data");
                            return response.text();
                        })
                        .then(html => {
                            modalContent.innerHTML = html;
                        })
                        .catch(error => {
                            modalContent.innerHTML =
                                '<p class="text-danger">Gagal memuat data.</p>';
                            console.error(error);
                        });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.kategori-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    const nominal = this.options[this.selectedIndex].dataset.nominal;
                    const modal = this.closest('.modal');
                    if (modal) {
                        const nominalInput = modal.querySelector('.nominal-input');
                        if (nominalInput && nominal) {
                            nominalInput.value = nominal;
                        }
                    }
                });
            });
        });
    </script>
@endpush
