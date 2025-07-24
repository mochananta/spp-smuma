@extends('siswa.dashboard')

@section('content')
    <div class="container mt-4">
        <h4>Total Riwayat Pembayaran</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        {{-- <th>Jenis Pembayaran</th>
                        <th>Kategori</th> --}}
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $pembayaran)
                        <tr>
                            <td>{{ $pembayaran->tanggal_bayar }}</td>
                            {{-- <td>{{ ucfirst($pembayaran->tagihan->kategori->kategori ?? '-') }}</td>
                            <td>{{ $pembayaran->tagihan->kategori->nama ?? '-' }}</td> --}}
                            <td>Rp {{ number_format($pembayaran->nominal) }}</td>
                            <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada pembayaran yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($riwayat->count() > 0)
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total</th>
                            <th colspan="2">Rp {{ number_format($totalPembayaran) }}</th>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
@endsection
