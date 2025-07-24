@extends('siswa.dashboard')

@section('content')
    <div class="header-box mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">Pembayaran Ujian</h4>
            <p class="subtext">Berikut adalah detail tagihan pembayaran Ujian Anda</p>
        </div>
        <img src="{{ asset('assets/img/logo smuma.png') }}" alt="Logo" class="logo-img">
    </div>

    {{-- Informasi Siswa --}}
    <div class="card p-3 mb-4 shadow-sm border-0" style="border-radius: 0.5rem;">
        <h5 class="mb-3 fw-bold text-white px-3 py-2"
            style="background-color: #a7dfff; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">Data Siswa</h5>
        <div class="row px-3">
            <div class="col-md-6">
                <p><strong>Nama</strong> : {{ $siswa->nama }}</p>
                <p><strong>NIS</strong> : {{ $siswa->nis }}</p>
                <p><strong>No. Telp</strong> : {{ $siswa->telepon }}</p>
                <p><strong>Rombel</strong> : {{ $siswa->rombel->rombel ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Jurusan</strong> : {{ $siswa->rombel->jurusan->jurusan ?? '-' }}</p>
                <p><strong>Sekolah</strong> : SMKS Muhammadiyah 5 Srono</p>
                <p><strong>Tahun Ajaran</strong> : {{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Tabel Tagihan --}}
    <div class="card p-3 shadow-sm border-0" style="border-radius: 0.5rem;">
        <h5 class="mb-3 fw-bold text-white px-3 py-2"
            style="background-color: #a7dfff; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
            Tagihan Ujian
        </h5>

        @if ($tagihans->isEmpty())
            <div class="alert alert-warning text-center">Tidak ada data tagihan untuk ujian.</div>
        @else
            <form id="form-ujian" class="px-3">
                <table class="table table-bordered align-middle mb-3">
                    <thead class="table-light">
                        <tr>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th class="text-center">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihans as $tagihan)
                            <tr>
                                <td>{{ $tagihan->bulan }}</td> {{-- Bisa diisi "UTS", "UAS", dll --}}
                                <td>Rp. {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <input type="checkbox" name="ujian[]" value="{{ $tagihan->id }}"
                                        class="form-check-input bulan-check" data-nominal="{{ $tagihan->nominal }}"
                                        onchange="hitungTotalUjian()">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light fw-bold">
                            <td colspan="2" class="text-end">Total Tagihan</td>
                            <td class="text-center" id="totalTagihanUjian">Rp. 0</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">Bayar</button>
                </div>
            </form>
        @endif
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        function hitungTotalUjian() {
            let total = 0;
            document.querySelectorAll('.bulan-check:checked').forEach(function(checkbox) {
                total += parseInt(checkbox.getAttribute('data-nominal'));
            });

            document.getElementById('totalTagihanUjian').innerText = 'Rp. ' + total.toLocaleString('id-ID');
        }
    </script>
@endpush
