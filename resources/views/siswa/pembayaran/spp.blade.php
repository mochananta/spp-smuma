@extends('siswa.dashboard')

@section('content')
    <div class="header-box mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">Pembayaran SPP</h4>
            <p class="subtext">Berikut adalah detail tagihan pembayaran SPP Anda</p>
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
            Tagihan SPP
        </h5>

        @if ($tagihans->isEmpty())
            <div class="alert alert-warning text-center">Tidak ada data tagihan untuk siswa ini.</div>
        @else
            <form id="form-spp" class="px-3">
                <table class="table table-bordered align-middle mb-3">
                    <thead class="table-light">
                        <tr>
                            <th>Bulan</th>
                            <th>Nominal</th>
                            <th class="text-center">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($tagihans as $tagihan)
                            <tr>
                                <td>{{ $tagihan->bulan }}</td>
                                <td>Rp. {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <input type="checkbox" name="bulan[]" value="{{ $tagihan->id }}"
                                        class="form-check-input bulan-check" data-nominal="{{ $tagihan->nominal }}"
                                        onchange="hitungTotal()">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light fw-bold">
                            <td colspan="2" class="text-end">Total Tagihan</td>
                            <td class="text-center" id="totalTagihan">Rp. 0</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-end">
                    <button type="button" onclick="bayarSekarang()" class="btn btn-primary">Bayar Sekarang</button>
                </div>
            </form>
        @endif
    </div>
@endsection

<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    function bayarSekarang() {
        const checkboxes = document.querySelectorAll('.bulan-check:checked');
        const tagihanIds = [];
        let total = 0;

        checkboxes.forEach(cb => {
            tagihanIds.push(cb.value);
            total += parseInt(cb.getAttribute('data-nominal'));
        });

        if (tagihanIds.length === 0) {
            alert("Silakan pilih minimal 1 tagihan.");
            return;
        }

        const data = {
            tagihan_ids: tagihanIds,
            total: total
        };

        fetch('/snap/bayar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    window.snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            alert("Pembayaran sukses!");
                            console.log(result);
                            location.reload(); // reload untuk update tampilan
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran...");
                            console.log(result);
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
                            console.log(result);
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran.");
                    console.log(data);
                }
            })
            .catch(error => {
                console.error("Terjadi kesalahan:", error);
                alert("Terjadi kesalahan saat memproses pembayaran.");
            });
    }
</script>


<script>
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.bulan-check:checked').forEach(function(el) {
            total += parseInt(el.getAttribute('data-nominal'));
        });
        document.getElementById('totalTagihan').innerText = 'Rp. ' + total.toLocaleString('id-ID');
    }
</script>
