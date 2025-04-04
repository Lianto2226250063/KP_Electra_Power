@extends('layouts.main')
@section('title','Tambah Jenis')

@section('content')
<h1 style="color: white">Halaman Jenis</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Tambah Jenis</h4>
                <p class="card-description" style="color: white">Formulir tambah jenis</p>
                <form class="forms-sample" method="POST" action="{{route('jenis.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Jenis</label>
                        <input type="text" class="form-control" name="nama" placeholder="Type here...">
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
