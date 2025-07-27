@extends('siswa.dashboard')

@section('content')
    <div class="container mt-4">
        <h4>Tagihan SPP</h4>
        <div class="table-responsive mb-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihanSpp as $tagihan)
                        <tr>
                            <td>{{ $tagihan->bulan }}</td>
                            <td>{{ $tagihan->kelas }}</td>
                            <td>{{ $tagihan->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                            <td>Rp {{ number_format($tagihan->nominal) }}</td>
                            <td>
                                @if ($tagihan->status === 'lunas')
                                    <span class="badge bg-success text-uppercase">{{ $tagihan->status }}</span>
                                @elseif ($tagihan->status === 'belum_lunas')
                                    <span
                                        class="badge bg-danger text-uppercase">{{ str_replace('_', ' ', $tagihan->status) }}</span>
                                @else
                                    <span class="badge bg-secondary text-uppercase">{{ $tagihan->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada tagihan SPP.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="container mt-4">
            <h4 class="mb-4">Riwayat Pembayaran SPP</h4>

            @if ($riwayat->isEmpty())
                <div class="alert alert-info">Belum ada pembayaran SPP yang tercatat.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $i => $trx)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}</td>
                                    <td>Rp {{ number_format($trx->gross_amount, 0, ',', '.') }}</td>
                                    <td>{{ $trx->keterangan ?? 'Pembayaran SPP' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection