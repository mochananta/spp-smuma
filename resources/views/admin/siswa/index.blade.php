@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Data Siswa</h2>
        </div>

        {{-- Form Pindah dan Hapus Siswa --}}
        <form id="form-tindakan" method="POST" action="{{ route('siswa.pindah') }}">
            @csrf

            <div class="row mb-3 align-items-end">
                <div class="col-md-3">
                    <label for="searchInput" class="form-label">Cari Siswa:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Nama atau NISN...">
                </div>
                <div class="col-md-3">
                    <label for="rombel_id" class="form-label">Rombel Tujuan:</label>
                    <select name="rombel_id" id="rombel_id" class="form-select" required>
                        <option value="">Pilih Rombel...</option>
                        @foreach ($rombels as $rombel)
                            <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran:</label>
                    <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select" required>
                        <option value="">Pilih Tahun Ajaran...</option>
                        @foreach ($tahunAjarans as $tahun)
                            <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Pindah</button>
                    <button type="button" class="btn btn-danger w-100" id="btnDelete">Hapus</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $siswa->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm text-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailSiswa{{ $siswa->id }}">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="detailSiswa{{ $siswa->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Siswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                                            <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                                            <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</p>
                                            <p><strong>Rombel:</strong> {{ $siswa->rombel->rombel ?? '-' }}</p>
                                            <p><strong>Jurusan:</strong> {{ $siswa->rombel->jurusan->jurusan ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        {{-- Form Delete --}}
        <form id="form-delete" method="POST" action="{{ route('siswa.delete.massal') }}" style="display:none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="ids" id="delete_ids">
        </form>
    </div>
@endsection

@push('myscript')
    <script>
        // Filter pencarian
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll("table tbody tr").forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(keyword) ? "" : "none";
            });
        });

        // Centang semua checkbox
        document.getElementById('checkAll').addEventListener('change', function() {
            const status = this.checked;
            document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = status);
        });

        // Hapus siswa massal
        document.getElementById('btnDelete').addEventListener('click', function() {
            const selected = Array.from(document.querySelectorAll('input[name="ids[]"]:checked'))
                                  .map(cb => cb.value);
            if (selected.length === 0) {
                alert('Pilih minimal satu siswa untuk dihapus.');
                return;
            }
            if (!confirm('Yakin ingin menghapus siswa terpilih? Data yang dihapus tidak bisa dikembalikan.')) {
                return;
            }
            document.getElementById('delete_ids').value = selected.join(',');
            document.getElementById('form-delete').submit();
        });
    </script>
@endpush
