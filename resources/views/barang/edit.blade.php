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

                    <br>
                    <button type="submit" class="btn btn-outline-success btn-sm">Simpan Perubahan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-danger btn-sm">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
