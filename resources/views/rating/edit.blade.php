@extends('layouts.main')
@section('title','Tambah Rating')

@section('content')
<h1 style="color: white">Halaman Rating</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Ubah Rating</h4>
                <p class="card-description" style="color: white">Formulir Ubah Rating</p>
                <form class="forms-sample" method="POST" action="{{route('rating.update', $rating->id)}}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="nama" style="color: white">Nama Rating</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Rating" value="{{$rating['nama']}}">
                        @error('nama')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{ url('rating') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
