@extends('siswa.dashboard')

@section('content')
<div class="container mt-4">
    <h4>Tagihan Ujian</h4>
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Ujian</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tagihanUjian as $tagihan)
                    <tr>
                        <td>{{ $tagihan->kategori->nama }}</td>
                        <td>Rp {{ number_format($tagihan->nominal) }}</td>
                        <td>{{ ucfirst($tagihan->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Tidak ada tagihan ujian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h5>Riwayat Pembayaran Ujian</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->tanggal }}</td>
                        <td>Rp {{ number_format($pembayaran->jumlah) }}</td>
                        <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada pembayaran ujian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
