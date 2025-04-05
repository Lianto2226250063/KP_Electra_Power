@extends('layouts.main')
@section('title','Add List Film')

@section('content')
<div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body bg-dark">
                    <h4 class="card-title !tw-text-white">Jual Makanan</h4>
                    <p class="card-description tw-text-white">
                        List Film
                    </p>

                     <form class="forms-sample" method="POST" action="{{route('jual.store')}}" enctype="multipart/form-data">
                    @csrf
                    {{-- Mengisi nama film--}}
                    <div class="form-group">
                      <label for="jual_id" class="tw-text-white">Nama Makanan</label>
                      <input type="text" class="form-control" name="nama" placeholder="Type here...">
                      @error('nama')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi nama toko--}}
                    <div class="form-group">
                      <label for="jual_id" class="tw-text-white">Nama Toko</label>
                      <input type="text" class="form-control" name="toko" placeholder="Type here...">
                      @error('toko')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi deskripsi film --}}
                    <div class="form-group">
                      <label for="jual_id" class="tw-text-white">Deskripsi</label>
                      <input type="text" class="form-control" name="deskripsi" placeholder="Type here...">
                      @error('deskripsi')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi foto --}}
                     <div class="form-group">
                      <label for="jual_id" class="tw-text-white">Foto</label>
                      <input type="file" class="form-control" name="foto" placeholder="Type here...">
                      @error('foto')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi harga --}}
                    <div class="form-group">
                      <label for="jual_id" class="tw-text-white">harga</label>
                      <input type="double" class="form-control" name="harga" placeholder="Type here...">
                      @error('harga')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{route('home')}}" class="btn btn-outline-danger btn-sm">Cancel</a>
                  </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
