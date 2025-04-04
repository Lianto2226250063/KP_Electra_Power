@extends('layouts.main')
@section('title','Tambah Studio')

@section('content')
<h1 style="color: white">Halaman Studio</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Ubah Studio</h4>
                <p class="card-description" style="color: white">Formulir Ubah Studio</p>
                <form class="forms-sample" method="POST" action="{{route('studio.update', $studio->id)}}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="nama" style="color: white">Nama Studio</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Studio" value="{{$studio['nama']}}">
                        @error('nama')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{ url('studio') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
