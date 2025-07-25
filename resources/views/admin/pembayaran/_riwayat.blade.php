<h5>Riwayat Pembayaran - {{ $siswa->nama }}</h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Bulan</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pembayarans as $p)
            <tr>
                <td>{{ $p->tanggal_bayar }}</td>
                <td>{{ $p->kategoriPembayaran->kategori ?? '-' }}</td>
                <td>{{ $p->bulan ?? '-' }}</td>
                <td>Rp{{ number_format($p->nominal) }}</td>
                <td>{{ $p->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada pembayaran</td>
            </tr>
        @endforelse
    </tbody>
</table>
