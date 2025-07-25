@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Kelola Siswa</h2>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-success" type="button" id="btn-tambah-data">
                    <i class="fa fa-plus me-2"></i>Tambah Data
                </button>
                {{-- <button class="btn p-0 border-0 bg-transparent d-flex align-items-center" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="5" r="0.6" />
                        <circle cx="12" cy="12" r="0.6" />
                        <circle cx="12" cy="19" r="0.6" />
                    </svg>
                </button> --}}
                {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li class="dropdown-header">Opsi Tambahan</li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="#" id="btn-import">
                            <img src="https://img.icons8.com/fluency-systems-regular/48/import.png" alt="import"
                                width="16" height="16">
                            Import
                        </a>
                    </li>
                </ul> --}}
            </div>
        </div>
        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
            class="d-flex flex-column align-items-start gap-3">
            @csrf
            <small class="form-text text-muted mb-2">
                Hanya file <strong>.xlsx</strong> yang dapat diimpor. Maksimal ukuran file 2MB.
            </small>
            <div class="mb-3">
                <a href="{{ asset('template/template_siswa.xlsx') }}" class="btn btn-success btn-sm d-block" download>
                    <i class="fa fa-download me-1"></i> Download Template
                </a>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                <input type="file" class="form-control" name="file" accept=".csv, .xlsx" required
                    style="max-width: 250px;">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <ion-icon name="cloud-download-outline"></ion-icon> Import
                </button>
            </div>
        </form>

        <div class="d-flex align-items-center gap-2 mb-3">
            <div class="input-group" style="width: 300px;">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                </span>
                <input type="text" class="form-control" placeholder="Cari..." aria-label="search"
                    aria-describedby="search" id="searchInput">
            </div>

            <div class="d-flex gap-2 ms-3">
                <button class="btn btn-outline-dark btn-sm" id="btnPrint">Print</button>
                <button class="btn btn-outline-dark btn-sm" id="btnPDF">PDF</button>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body border-bottom py-3 px-4">

                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="checkAllSiswa">
                                </th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th class="text-center">Opsional</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <td><input type="checkbox" class="check-item" name="ids[]"
                                            value="{{ $siswa->id }}"></td>
                                    <td>{{ $siswa->id }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ optional($siswa->rombel)->rombel ?? 'Belum dipilih' }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-info-circle btn-detail-siswa"
                                            data-id="{{ $siswa->id }}" style="cursor:pointer;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 9h.01" />
                                            <path d="M11 12h1v4h1" />
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

    <div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="modalCreateUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form class="form-sample" action="{{ route('siswa.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateUserLabel">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIS</label>
                                <input type="text" class="form-control" name="nis" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Agama</label>
                                <select class="form-control" name="agama" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            value="laki-laki" checked>
                                        <label class="form-check-label">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            value="perempuan">
                                        <label class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Telepon Siswa</label>
                                <input type="text" class="form-control" name="telepon" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Orang Tua</label>
                                <input type="text" class="form-control" name="nama_ortu" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Telepon Orang Tua</label>
                                <input type="text" class="form-control" name="telepon_ortu" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Kelas</label>
                                <select name="rombel_id" class="form-control" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($rombels as $rombel)
                                        <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jurusan</label>
                                <select name="jurusan_id" class="form-control" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" class="form-control" required>
                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                    @foreach ($tahunAjarans as $tahun)
                                        <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }} -
                                            {{ $tahun->semester }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Unggah Foto</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-detail-siswa').click(function() {
                var siswaId = $(this).data('id');
                var url = '/siswa/' + siswaId + '/detail-a4';
                $('#detailSiswaModal').modal('show');
                $('#modalBodyContent').html('Loading...');
                $.get(url, function(data) {
                    $('#modalBodyContent').html(data);
                }).fail(function() {
                    $('#modalBodyContent').html('<p>Gagal memuat data.</p>');
                });
            });

            const checkAllSiswa = document.getElementById('checkAllSiswa');
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            if (checkAllSiswa) {
                checkAllSiswa.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            }
        });

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
        document.getElementById('btnPrint').addEventListener('click', function() {
            const content = document.querySelector('.table-responsive').innerHTML;
            const newWindow = window.open('', '', 'height=800,width=1200');
            newWindow.document.write('<html><head><title>Print Siswa</title>');
            newWind ow.document.write(
                '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">'
            );
            newWindow.document.write('</head><body>');
            newWindow.document.write('<h3 class="text-center mb-4">Daftar Siswa</h3>');
            newWindow.document.write('<div class="container">');
            newWindow.document.write(content);
            newWindow.document.write('</div></body></html>');
            newWindow.document.close();
            newWindow.focus();
            newWindow.print();
            newWindow.close();
        });

        document.getElementById('btnPDF').addEventListener('click', function() {
            const element = document.querySelector('.table-responsive');
            const opt = {
                margin: 0.5,
                filename: 'daftar-siswa.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            html2pdf().set(opt).from(element).save();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(function(row) {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(filter) ? '' : 'none';
                });
            });
        });
    </script>
@endpush
