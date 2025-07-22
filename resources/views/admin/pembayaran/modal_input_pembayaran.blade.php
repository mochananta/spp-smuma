{{-- <!-- modal_input_pembayaran.blade.php -->
<div class="modal fade" id="modalInputPembayaran" tabindex="-1" aria-labelledby="modalInputPembayaranLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="formInputPembayaran" method="POST" action="{{ route('pembayaran.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInputPembayaranLabel">
                        Input Pembayaran: <span id="jenisPembayaranText" class="text-primary"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="jenis_pembayaran" id="jenisPembayaranInput" value="">
                    <input type="hidden" name="siswa_id" id="siswaIdInput" value="">

                    <div class="mb-3">
                        <label for="jumlahPembayaran" class="form-label">Jumlah Pembayaran</label>
                        <input type="number" class="form-control" id="jumlahPembayaran" name="jumlah" required
                            min="0" step="any" placeholder="Masukkan jumlah pembayaran">
                    </div>

                    <div class="mb-3">
                        <label for="tanggalPembayaran" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" class="form-control" id="tanggalPembayaran" name="tanggal" required
                            value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.dropdown-menu .trigger-modal').forEach(function(el) {
            el.addEventListener('click', function() {
                const tr = this.closest('tr');
                const siswaId = tr.querySelector('.btn-detail-siswa')?.getAttribute(
                    'data-id') ?? '';
                const jenis = this.getAttribute('data-jenis') ?? 'Pembayaran';

                // Isi input hidden dan teks jenis pembayaran
                document.getElementById('siswaIdInput').value = siswaId;
                document.getElementById('jenisPembayaranInput').value = jenis;
                document.getElementById('jenisPembayaranText').innerText = jenis.toUpperCase();

                // Reset nilai input jumlah pembayaran
                document.getElementById('jumlahPembayaran').value = '';
            });
        });
    });
</script>
