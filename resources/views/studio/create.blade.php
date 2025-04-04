@extends('layouts.main')
@section('title','Tambah Studio')

@section('content')
<h1 class="tw-text-white">Halaman Studio</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Tambah Studio</h4>
                <p class="card-description " style="color: white">Formulir tambah studio</p>
                <form class="forms-sample" method="POST" action="{{route('studio.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Studio</label>
                        <input type="text" class="form-control" name="nama" placeholder="Type here...">
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
