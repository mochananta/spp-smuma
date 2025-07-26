@extends('admin.dashboardsmuma')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 mb-4" style="max-width: 700px; margin: auto;">
            <div class="card-body" id="laporanContent">
                <h5 class="text-center text-primary fw-bold mb-3">Laporan Penerimaan SPP</h5>

                <form method="GET" action="{{ route('admin.laporan.spp') }}" class="row g-2 mb-3">
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
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                    </div>
                </form>

                <div class="d-flex justify-content-end gap-2 mb-3">
                    <button class="btn btn-outline-dark btn-sm" id="btnPrint">Print</button>
                    <button class="btn btn-outline-dark btn-sm" id="btnPDF">PDF</button>
                </div>

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
                <p class="text-center text-muted small mb-0">
                    Data ditampilkan berdasarkan filter bulan dan tahun pembayaran
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- html2pdf.js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById('btnPrint').addEventListener('click', function () {
            const content = document.getElementById('laporanContent').innerHTML;
            const win = window.open('', '', 'height=800,width=1200');
            win.document.write('<html><head><title>Cetak Laporan</title>');
            win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
            win.document.write('</head><body>');
            win.document.write('<div class="container mt-4">');
            win.document.write(content);
            win.document.write('</div></body></html>');
            win.document.close();
            win.focus();
            win.print();
            win.close();
        });

        document.getElementById('btnPDF').addEventListener('click', function () {
            const element = document.getElementById('laporanContent');
            const opt = {
                margin: 0.5,
                filename: 'laporan-penerimaan-spp.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        });
    </script>
@endpush
