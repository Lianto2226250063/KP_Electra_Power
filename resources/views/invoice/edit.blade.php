@extends('layouts.main')

@section('title', 'Edit Invoice')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        @php
        $details = old('keterangan') 
            ? collect(old('keterangan'))->map(function ($k, $i) {
                return [
                    'id' => old('detailId')[$i] ?? null,
                    'keterangan' => $k,
                    'jumlah' => old('jumlah')[$i] ?? '',
                    'harga_satuan' => old('harga_satuan')[$i] ?? '',
                ];
            }) 
            : ($invoice->items ?? collect())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'keterangan' => $item->keterangan,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                ];
            });
        $jsonDetails = htmlspecialchars(json_encode($details), ENT_QUOTES, 'UTF-8');
        @endphp

        <div class="card" x-data="invoiceForm({!! $jsonDetails !!})">
            <div class="card-body rounded">
                <h4 class="card-title text-4xl text-center">Edit Invoice</h4>
                <p class="card-description text-xl">Perbarui data invoice</p>
                <br>
                <form class="forms-sample" method="POST" action="{{ route('invoice.update', $invoice->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="nomor">Nomor Invoice</label>
                        <div class="input-group">
                            <input type="text" id="nomor" class="form-control" name="nomor" value="{{ old('nomor', substr($invoice->nomor, 0, -6)) }}" required readonly>
                            <span class="input-group-text bg-light" id="bulanTahunDisplay">/--/--</span>
                        </div>
                        @error('nomor')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kepada">Kepada</label>
                        <input type="text" class="form-control" name="kepada" value="{{ old('kepada', $invoice->kepada) }}" required>
                        @error('kepada')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $invoice->tanggal) }}" required>
                        @error('tanggal')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <br>
                    <h4 class="text-xl">Detail Invoice</h4>

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
                                            <input type="hidden" name="detailId[]" :value="detail.id">
                                            <input type="text" class="form-control" name="keterangan[]" list="daftarBarang" x-model="detail.keterangan" @input="updateHarga(index)" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="detail.jumlah" name="jumlah[]" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="detail.harga_satuan" name="harga_satuan[]" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" @click="removeDetail(index)" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <datalist id="daftarBarang">
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->nama }}">
                            @endforeach
                        </datalist>
                    </div>

                    <button type="button" @click="addDetail" class="btn btn-outline-primary btn-sm mt-2">Tambah Detail</button>
                    <br><br>
                    <button type="submit" class="btn btn-outline-success btn-sm">Simpan Perubahan</button>
                    <a href="{{ route('invoice.index') }}" class="btn btn-outline-danger btn-sm">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function invoiceForm(initialDetails) {
        return {
            details: initialDetails,
            barangMap: @json($barangs->pluck('harga', 'nama')),
            updateHarga(index) {
                const nama = this.details[index].keterangan;
                this.details[index].harga_satuan = this.barangMap[nama] ?? '';
            },
            addDetail() {
                this.details.push({ id: null, keterangan: '', jumlah: '', harga_satuan: '' });
            },
            removeDetail(index) {
                this.details.splice(index, 1);
            }
        };
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