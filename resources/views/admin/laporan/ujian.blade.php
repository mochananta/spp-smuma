@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Data Siswa</h2>
        </div>

        <div class="d-flex justify-content-center mb-4 mt-5">
            <div class="card shadow-sm border" style="width: 600px;">
                <div class="card-body">
                    <h5 class="text-center fw-bold">Laporan Penerimaan Ujian</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted">Per Tanggal :</span><br>
                            <span class="fw-bold">{{ $tanggal }}</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted">Total :</span><br>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Tahun --}}
        <div class="d-flex justify-content-center">
            <div class="d-flex align-items-center" style="margin-left: 420px;">
                <label for="tahun" class="fw-semibold me-2 mb-0">Tahun :</label>
                <select class="form-select" id="tahun" name="tahun" style="width: 120px;">
                    <option value="2024" selected>2024</option>
                    <option value="2023">2023</option>
                </select>
            </div>
        </div>
    </div>
@endsection
