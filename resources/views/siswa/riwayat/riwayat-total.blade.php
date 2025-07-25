@extends('siswa.dashboard')

@section('content')
    <div class="container mt-4">
        <h4>Total Riwayat Pembayaran</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $pembayaran)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}</td>
                            <td>{{ $pembayaran->kategoriPembayaran->kategori ?? '-' }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal) }}</td>
                            <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada pembayaran yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($riwayat->count() > 0)
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="2" class="text-end">Total</td>
                            <td colspan="2">Rp {{ number_format($totalPembayaran) }}</td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
@endsection
