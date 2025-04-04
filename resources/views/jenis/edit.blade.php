@extends('layouts.main')
@section('title','Tambah Jenis')

@section('content')
<h1 style="color: white">Halaman Jenis</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Ubah Jenis</h4>
                <p class="card-description" style="color: white">Formulir Ubah Jenis</p>
                <form class="forms-sample" method="PUT" action="{{route('jenis.update', $jenis->id)}}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="nama" style="color: white">Nama Jenis</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Jenis" value="{{$jenis['nama']}}">
                        @error('nama')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{ url('jenis') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
