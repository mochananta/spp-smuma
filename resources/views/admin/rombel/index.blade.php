@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Rombel</h2>
            <button class="btn btn-success ms-auto" type="button" id="btn-tambah-data">
                <i class="fa fa-plus me-2"></i>Tambah
            </button>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari...">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rombel</th>
                                <th>Tingkat</th>
                                <th>Jurusan</th>
                                <th>Tahun Ajaran</th>
                                <th>Opsional</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rombels as $rombel)
                                <tr>
                                    <td>{{ $rombel->id }}</td>
                                    <td>{{ $rombel->rombel }}</td>
                                    <td>{{ $rombel->tingkat->tingkat ?? '-' }}</td>
                                    <td>{{ $rombel->jurusan->jurusan ?? '-' }}</td>
                                    <td>{{ $rombel->tahunAjaran->tahun_ajaran ?? '-' }} -
                                        {{ $rombel->tahunAjaran->semester ?? '-' }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $rombel->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('rombel.destroy', $rombel->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus rombel ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $rombel->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $rombel->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('rombel.update', $rombel->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $rombel->id }}">
                                                                Edit Rombel</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="rombel">Rombel</label>
                                                                <input type="text" name="rombel" class="form-control"
                                                                    value="{{ $rombel->rombel }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tingkat">Tingkat</label>
                                                                <select name="tingkat" class="form-select" required>
                                                                    <option value="X"
                                                                        {{ $rombel->tingkat == 'X' ? 'selected' : '' }}>X
                                                                    </option>
                                                                    <option value="XI"
                                                                        {{ $rombel->tingkat == 'XI' ? 'selected' : '' }}>XI
                                                                    </option>
                                                                    <option value="XII"
                                                                        {{ $rombel->tingkat == 'XII' ? 'selected' : '' }}>
                                                                        XII</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jurusan_id">Jurusan</label>
                                                                <select name="jurusan_id" class="form-select" required>
                                                                    <option value="">-- Pilih Jurusan --</option>
                                                                    @foreach ($jurusans as $jurusan)
                                                                        <option value="{{ $jurusan->id }}"
                                                                            {{ $rombel->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                                                            {{ $jurusan->jurusan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tahun_ajaran_id">Tahun Ajaran</label>
                                                                <select name="tahun_ajaran_id" class="form-select" required>
                                                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                                                    @foreach ($tahun_ajarans as $ta)
                                                                        <option value="{{ $ta->id }}"
                                                                            {{ $rombel->tahun_ajaran_id == $ta->id ? 'selected' : '' }}>
                                                                            {{ $ta->tahun_ajaran }} - {{ $ta->semester }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
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

    <!-- Modal Tambah Rombel -->
    <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('rombel.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateUserLabel">Tambah Rombel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rombel">Rombel</label>
                            <input type="text" name="rombel" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tingkat_id">Tingkat</label>
                            <select name="tingkat_id" class="form-control" required>
                                <option value="">--Pilih Tingkat--</option>
                                @foreach ($tingkats as $tingkat)
                                    <option value="{{ $tingkat->id }}">{{ $tingkat->tingkat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" class="form-control" required>
                                <option value="">--Pilih Jurusan--</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_ajaran_id">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-control" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                @foreach ($tahun_ajarans as $tahun_ajaran)
                                    <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->tahun_ajaran }} -
                                        {{ $tahun_ajaran->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btn-tambah-data').addEventListener('click', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modalCreateUser'), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
@endpush
