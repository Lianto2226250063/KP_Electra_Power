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

                {{-- Input Nama Barang --}}
                <div class="form-group">
                    <label for="nama">Nama Barang / Jasa</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama barang / jasa" value="{{ old('nama') }}" required>
                    @error('nama')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                {{-- Input Harga --}}
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" class="form-control" name="harga" placeholder="Masukkan harga" value="{{ old('harga') }}" required>
                    @error('harga')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <br>
                <!-- Tombol Submit dan Cancel -->
                <div class="d-flex justify-content-start gap-3">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-outline-success btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
