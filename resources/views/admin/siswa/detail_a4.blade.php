<div class="container mt-4 mb-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="d-flex align-items-center mb-4">
            @if ($siswa->foto)
                <img src="{{ asset('storage/foto/' . $siswa->foto) }}"
                    class="rounded-circle me-3 border shadow-sm"
                    width="100" height="100" style="object-fit: cover;" alt="Foto Siswa">
            @else
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3"
                    style="width: 100px; height: 100px; font-size: 2.2rem;">
                    {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                </div>
            @endif

            <div>
                <h5 class="mb-1 fw-bold">{{ $siswa->nama }}</h5>
                <span class="badge bg-primary-subtle text-primary fw-semibold">
                    {{ $siswa->rombel->rombel ?? '-' }}
                </span>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-md-4">
                <div class="text-muted small">NIS</div>
                <div class="fw-semibold fs-6">{{ $siswa->nis }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Jurusan</div>
                <div class="fw-semibold fs-6">{{ $siswa->jurusan->jurusan ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Email</div>
                <div class="fw-semibold fs-6">{{ $siswa->email }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Agama</div>
                <div class="fw-semibold fs-6">{{ $siswa->agama }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Alamat</div>
                <div class="fw-semibold fs-6">{{ $siswa->alamat }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Jenis Kelamin</div>
                <div class="fw-semibold fs-6">{{ $siswa->jenis_kelamin }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Tempat, Tanggal Lahir</div>
                <div class="fw-semibold fs-6">
                    {{ $siswa->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Nama Orang Tua</div>
                <div class="fw-semibold fs-6">{{ $siswa->nama_ortu }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Telepon Orang Tua</div>
                <div class="fw-semibold fs-6">{{ $siswa->telepon_ortu }}</div>
            </div>
        </div>
    </div>
</div>
