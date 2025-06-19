@extends('layouts.main')

@section('title', 'Tambah Invoice')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div x-data="invoiceForm()">
            <div class="card-body rounded">
                <h4 class="card-title text-4xl text-center">Buat Invoice</h4>
                <p class="card-description text-xl">Masukkan data invoice</p>
                <br>
                <form class="forms-sample" method="POST" action="{{ route('invoice.store') }}">
                    @csrf
                    {{-- Input untuk tabel invoices --}}
                    <div class="form-group">
                        <label for="nomor">Nomor Invoice</label>
                        <div class="input-group">
                            <input type="text" id="nomor" class="form-control" name="nomor" placeholder="Masukkan nomor invoice" required>
                            <span class="input-group-text bg-light" id="bulanTahunDisplay">/--/--</span>
                        </div>
                        @error('nomor')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kepada">Kepada</label>
                        <input type="text" class="form-control" name="kepada" placeholder="Masukkan nama penerima" required>
                        @error('kepada')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ now()->toDateString() }}" required>
                        @error('tanggal')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <br>
                    <h4 class="text-xl">Detail Invoice</h4>

                    {{-- Tabel untuk Detail Invoice --}}
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Harga Satuan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(detail, index) in details" :key="index">
                                    <tr>
                                        <td>
                                            <input type="text"
                                                   class="form-control"
                                                   name="keterangan[]"
                                                   list="daftarBarang"
                                                   x-model="detail.keterangan"
                                                   @input="updateHarga(index)"
                                                   placeholder="Ketik atau pilih barang/jasa"
                                                   required>
                                            <datalist id="daftarBarang">
                                                @foreach($barangs as $barang)
                                                    <option value="{{ $barang->nama }}">
                                                @endforeach
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="detail.jumlah" name="jumlah[]" placeholder="Jumlah" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="detail.harga_satuan" name="harga_satuan[]" placeholder="Harga Satuan" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" @click="details.splice(index, 1)" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" @click="details.push({ keterangan: '', jumlah: '', harga_satuan: '' })" class="btn btn-outline-primary btn-sm mt-2">Tambah Detail</button>
                    <br><br>

                    <!-- Tombol Submit dan Cancel -->
                    <button type="submit" class="btn btn-outline-success btn-sm me-2">Submit</button>
                    <a href="{{ route('invoice.index') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function invoiceForm() {
        return {
            details: [{ keterangan: '', jumlah: '', harga_satuan: '' }],
            barangMap: @json($barangs->pluck('harga', 'nama')),
            updateHarga(index) {
                const nama = this.details[index].keterangan;
                this.details[index].harga_satuan = this.barangMap[nama] ?? '';
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const tanggalInput = document.querySelector('input[name="tanggal"]');
        const bulanTahunDisplay = document.getElementById('bulanTahunDisplay');

        function updateBulanTahun() {
            const value = tanggalInput.value;
            if (value) {
                const date = new Date(value);
                const bulan = String(date.getMonth() + 1).padStart(2, '0');
                const tahun = String(date.getFullYear()).slice(-2);
                bulanTahunDisplay.textContent = '/' + bulan + '-' + tahun;
            } else {
                bulanTahunDisplay.textContent = '/--/--';
            }
        }

        tanggalInput.addEventListener('input', updateBulanTahun);
        updateBulanTahun();
    });
</script>
@endpush
