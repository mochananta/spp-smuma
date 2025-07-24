@extends('siswa.dashboard')

@section('content')
    <div class="container mt-4">
        <h4>Tagihan Ujian</h4>
        <div class="table-responsive mb-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihanUjian as $tagihan)
                        <tr>
                            <td>{{ $tagihan->bulan }}</td>
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
                        <th>Kategori Pembayaran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $pembayaran)
                        <tr>
                            <td>{{ $pembayaran->tanggal_bayar }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal) }}</td>
                            <td>{{ $pembayaran->kategoriPembayaran->kategori ?? '-' }}</td> {{-- Tambahan --}}
                            <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada pembayaran ujian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
