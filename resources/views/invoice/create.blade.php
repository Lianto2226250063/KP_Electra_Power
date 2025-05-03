@extends('layouts.main')

@section('title', 'Tambah Invoice')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" x-data="{ details: [{ keterangan: '', jumlah: '', harga_satuan: '' }] }">
            <div class="card-body bg-dark rounded">
                <h4 class="card-title text-white text-4xl text-center">Buat Invoice</h4>
                <p class="card-description text-white text-xl">Masukkan data invoice</p>
                <br>
                <form class="forms-sample" method="POST" action="{{ route('invoice.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Input untuk tabel invoices --}}
                    <div class="form-group">
                        <label for="nomor" class="text-white">Nomor Invoice</label>
                        <input type="text" class="form-control" name="nomor" placeholder="Masukkan nomor invoice" required>
                        @error('nomor')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kepada" class="text-white">Kepada</label>
                        <input type="text" class="form-control" name="kepada" placeholder="Masukkan nama penerima" required>
                        @error('kepada')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal" class="text-white">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ now()->toDateString() }}" required>
                        @error('tanggal')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi" class="text-white">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" value="Palembang" required>
                        @error('lokasi')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <br>
                    <h4 class="text-white text-xl">Detail Invoice</h4>

                    {{-- Tabel untuk Detail Invoice --}}
                    <div class="table-responsive">
                        <table class="table table-bordered text-white">
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
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
