@extends('admin.dashboardsmuma')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 mb-4" style="max-width: 700px; margin: auto;">
            <div class="card-body">
                <h5 class="text-center text-primary fw-bold mb-3">Laporan Penerimaan Ujian</h5>

                <form method="GET" action="{{ route('admin.laporan.ujian') }}" class="row g-2 mb-3">
                    <div class="col-md-5">
                        <select name="bulan" class="form-select">
                            @foreach (range(1, 12) as $b)
                                <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($b)->locale('id')->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="tahun" class="form-select">
                            @foreach (range(date('Y') - 2, date('Y')) as $y)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                    </div>
                </form>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">Periode Laporan:</small>
                        <div>{{ $tanggal }}</div>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">Total Penerimaan:</small>
                        <div class="fw-bold text-success fs-5">Rp {{ number_format($total, 0, ',', '.') }}</div>
                    </div>
                </div>

                <hr>
                <p class="text-center text-muted small mb-0">Data ditampilkan berdasarkan filter bulan dan tahun pembayaran
                </p>
            </div>
        </div>
    </div>
@endsection
