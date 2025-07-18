@extends('layouts.main')

@section('title', 'Edit Barang')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body rounded">
                <h4 class="card-title text-4xl text-center">Edit Barang</h4>
                <p class="card-description text-xl">Perbarui data barang</p>
                <br>
                <form class="forms-sample" method="POST" action="{{ route('barang.update', $barang->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" id="nama" class="form-control" name="nama" value="{{ old('nama', $barang->nama) }}" required>
                        @error('nama')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="harga" class="form-control" name="harga" value="{{ old('harga', $barang->harga) }}" step="0.01" required>
                        </div>
                        @error('harga')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="Jenis">Jenis</label>
                        <select name="Jenis" class="form-control ">
                            <option value="" disabled selected>Pilih Jenis</option>
                            <option value="Barang">Barang</option>
                            <option value="Jasa">Jasa</option>
                        </select>
                        @error('Jenis')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <br>
                    <button type="button" class="btn btn-outline-success btn-sm tw-m-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Submit</button>
                    <a href="/barang/index" class="btn btn-outline-danger btn-sm">Cancel</a>
                    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Submit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengubah barang ini?
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
