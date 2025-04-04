@extends('layouts.main')
@section('title','Tambah Genre')

@section('content')
<h1 style="color: white">Halaman Genre</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Tambah Genre</h4>
                <p class="card-description" style="color: white">Formulir tambah genre</p>
                <form class="forms-sample" method="POST" action="{{route('genre.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Genre</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Genre">
                        @error('nama')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{ url('genre') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
