@extends('layouts.main')
@section('title','Add List Film')

@section('content')
<div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body bg-dark">
                    <h4 class="card-title !tw-text-white">Tambah Film</h4>
                    <p class="card-description tw-text-white">
                        List Film
                    </p>

                     <form class="forms-sample" method="POST" action="{{route('listfilm.store')}}" enctype="multipart/form-data">
                    @csrf
                    {{-- Mengisi nama film--}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Nama Film</label>
                      <input type="text" class="form-control" name="nama" placeholder="Type here...">
                      @error('nama')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi deskripsi film --}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Deskripsi</label>
                      <input type="text" class="form-control" name="deskripsi" placeholder="Type here...">
                      @error('deskripsi')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi produser --}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Produser</label>
                      <input type="text" class="form-control" name="produser" placeholder="Type here...">
                      @error('produser')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi foto --}}
                     <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Foto</label>
                      <input type="file" class="form-control" name="foto" placeholder="Type here...">
                      @error('foto')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi skor --}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Skor</label>
                      <input type="double" class="form-control" name="skor" placeholder="Type here...">
                      @error('skor')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Memilih genre --}}
                    <div class="form-group">

                      <label for="genre_id" class="tw-text-white">Genre</label>
                      <select  class="form-control" name="genre_id">
                        <option value="">Pilih</option>
                        @foreach ($genre as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                      </select>
                      @error('genre_id')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Memilih studio --}}
                    <div class="form-group">

                      <label for="studio_id" class="tw-text-white">Studio</label>
                      <select  class="form-control" name="studio_id" >
                        <option value="">Pilih</option>
                        @foreach ($studio as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                      </select>
                      @error('studio_id')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Memilih jenis --}}
                    <div class="form-group">
                        <label for="jenis_id" class="tw-text-white">Jenis</label>
                        <select class="form-control" name="jenis_id">
                            <option value="">Pilih</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('jenis_id')
                            <label for="" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    {{-- Memilih rating --}}
                    <div class="form-group">
                      <!-- <label for="exampleInputUsername1">Prodi</label> -->
                      <label for="rating_id" class="tw-text-white">Rating</label>
                      <select  class="form-control" name="rating_id" >
                        <option value="">Pilih</option>
                        @foreach ($rating as $item)
                            <option value="{{$item->id}}">{{$item->rating}}</option>
                        @endforeach
                      </select>
                      @error('rating_id')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{route('home')}}" class="btn btn-outline-danger btn-sm">Cancel</a>
                  </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
