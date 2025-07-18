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
            : ($invoice->details ?? collect())->map(function ($item) {
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
                            <input type="text" id="nomor" class="form-control" name="nomor" value="{{ old('nomor', $invoice->nomor) }}" style="background-color: #f0f0f0;" required readonly>
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
                    <button type="button" @click="addDetail" class="btn btn-outline-primary btn-sm mt-2">Tambah Barang atau Jasa</button>
                    <br><br>
                    <button type="button" class="btn btn-outline-success btn-sm tw-m-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Ubah</button>
                    <a href="/invoice/index" class="btn btn-outline-danger btn-sm">Batal</a>
                    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pengeditan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengubah invoice ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-success">Ya</button>
                        </div>
                        </div>
                    </div>
                    </div>
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
</script>
@endpush
