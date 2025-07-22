@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Kategori Pembayaran</h2>
            <button class="btn btn-success ms-auto" type="button" id="btn-tambah-data">
                <i class="fa fa-plus me-2"></i>Tambah
            </button>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="input-group">
                    <!-- Ikon dalam input-group-text -->
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>

                    <!-- Input -->
                    <input type="text" class="form-control" placeholder="Cari..." id="searchInput" aria-label="search"
                        aria-describedby="search">
                </div>
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
                            <th>Kategori</th>
                            <th>Nominal</th>
                            <th>Opsional</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $kategori_pembayaran)
                            <tr>
                                <td>{{ $kategori_pembayaran->id }}</td>
                                <td>{{ $kategori_pembayaran->kategori }}</td>
                                <td>{{ $kategori_pembayaran->nominal }}</td>
                                <td>{{ $kategori_pembayaran->opsional }}
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editKategoriModal{{ $kategori_pembayaran->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" stroke="blue"
                                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editKategoriModal{{ $kategori_pembayaran->id }}"
                                        tabindex="-1"
                                        aria-labelledby="editKategoriModalLabel{{ $kategori_pembayaran->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form
                                                    action="{{ route('kategori_pembayaran.update', $kategori_pembayaran->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editKategoriModalLabel{{ $kategori_pembayaran->id }}">Edit
                                                            Kategori Pembayaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Kategori</label>
                                                            <input type="text" class="form-control" name="kategori"
                                                                value="{{ $kategori_pembayaran->kategori }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nominal" class="form-label">Nominal</label>
                                                            <input type="text" class="form-control" name="nominal"
                                                                value="{{ $kategori_pembayaran->nominal }}" required>
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
                                    <form action="{{ route('kategori.destroy', $kategori_pembayaran->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus tahun ajaran ini?');"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none; padding: 0;"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash me-3">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </form>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="modalCreateUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateUserLabel">Kategori Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-sample" action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6 mb-3">
                            <label for="kategori">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nominal">Nominal</label>
                                <input type="text" name="nominal" class="form-control" placeholder="" required>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endsection
        @push('myscript')
            <script>
                document.getElementById('btn-tambah-data').addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('modalCreateUser'), {
                        keyboard: false
                    });
                    myModal.show();
                });
                document.querySelector('.file-upload-browse').addEventListener('click', function() {
                    let fileInput = this.closest('.form-group').querySelector('.file-upload-default');
                    fileInput.click();
                });

                document.querySelector('.file-upload-default').addEventListener('change', function() {
                    let fileName = this.value.split('\\').pop();
                    this.closest('.form-group').querySelector('.file-upload-info').value = fileName;
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
        @endpush
