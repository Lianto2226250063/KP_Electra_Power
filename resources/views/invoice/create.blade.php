@extends('layouts.main')

@section('title', 'Tambah Invoice')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div x-data="{ details: [{ keterangan: '', jumlah: '', harga_satuan: '' }] }">
            <div class="card-body rounded">
                <h4 class="card-title text-4xl text-center">Buat Invoice</h4>
                <p class="card-description text-xl">Masukkan data invoice</p>
                <br>
                <form class="forms-sample" method="POST" action="{{ route('invoice.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Input untuk tabel invoices --}}
                    <div class="form-group">
                        <label for="nomor">Nomor Invoice</label>
                        <input type="text" class="form-control" name="nomor" placeholder="Masukkan nomor invoice" required>
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

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" value="Palembang" required>
                        @error('lokasi')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <br>
                    <h4 class=" text-xl">Detail Invoice</h4>

                    {{-- Tabel untuk Detail Invoice --}}
                    <div class="table-responsive">
                        <table class="table table-bordered ">
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
                                            <textarea class="form-control" x-model="details[index].keterangan" name="keterangan[]" placeholder="Masukkan keterangan barang/jasa" required></textarea>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="details[index].jumlah" name="jumlah[]" placeholder="Masukkan jumlah" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="details[index].harga_satuan" name="harga_satuan[]" placeholder="Masukkan harga satuan" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" @click="details.splice(index, 1)" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" @click="details.push({ keterangan: '', jumlah: '', harga_satuan: '' })" class="btn btn-outline-primary btn-sm tw-m-3">Tambah Detail</button>
                    <br><br>
                    <!-- Tombol Submit yang membuka modal -->
                    <button type="button" class="btn btn-outline-success btn-sm tw-m-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Submit</button>
                    <a href="/invoice/index" class="btn btn-outline-danger btn-sm">Cancel</a>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Submit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengirim invoice ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Ya, Submit</button>
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
