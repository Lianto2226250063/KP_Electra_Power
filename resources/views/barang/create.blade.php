@extends('layouts.main')

@section('title', 'Tambah Barang')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body rounded">
            <h4 class="card-title text-4xl text-center">Tambah Barang / Jasa</h4>
            <p class="card-description text-xl">Masukkan data barang atau jasa</p>
            <br>
            <form method="POST" action="{{ route('barang.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Barang / Jasa</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama barang / jasa" value="{{ old('nama') }}" required>
                    @error('nama')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" class="form-control" name="harga" placeholder="Masukkan harga" value="{{ old('harga') }}" required>
                    @error('harga')
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
                        Apakah Anda yakin ingin membuat barang ini?
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
@endsection
