@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Data Alumni</h2>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="searchInput" class="form-label">Cari Alumni:</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Nama atau NISN...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Lulus</th>
                        <th>Informasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnis as $alumni)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alumni->nis }}</td>
                            <td>{{ $alumni->nama }}</td>
                            <td>{{ $alumni->jenis_kelamin }}</td>
                            <td>{{ $alumni->tahun_lulus ?? '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm text-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailAlumni{{ $alumni->id }}">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail Alumni -->
                        <div class="modal fade" id="detailAlumni{{ $alumni->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Alumni</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>NIS:</strong> {{ $alumni->nis }}</p>
                                        <p><strong>Nama:</strong> {{ $alumni->nama }}</p>
                                        <p><strong>Email:</strong> {{ $alumni->email }}</p>
                                        <p><strong>Jenis Kelamin:</strong> {{ $alumni->jenis_kelamin }}</p>
                                        <p><strong>Rombel:</strong> {{ $alumni->rombel->rombel ?? '-' }}</p>
                                        <p><strong>Jurusan:</strong> {{ $alumni->jurusan->jurusan ?? '-' }}</p>
                                        <p><strong>Tahun Lulus:</strong> {{ $alumni->tahun_lulus }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($alumnis->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data alumni.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
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
    </script>
@endpush
