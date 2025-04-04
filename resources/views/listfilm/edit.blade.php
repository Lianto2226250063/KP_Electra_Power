@extends('layouts.main')
@section('title','Add List Film')

@section('content')
<div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body bg-dark">
                    <h4 class="card-title !tw-text-white">Ubah Data Film</h4>
                    <p class="card-description tw-text-white">
                        Daftar Film
                    </p>
                    <form class="forms-sample" method="POST" action="{{route('listfilm.update', ['listfilm' => $listfilm])}}" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')
                    {{-- Mengisi nama film--}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Nama Film</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Film" value="{{$listfilm['nama']}}">
                      @error('nama')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi deskripsi film --}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Deskripsi</label>
                      <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" value="{{$listfilm['deskripsi']}}">
                      @error('deskripsi')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Produser</label>
                      <input type="text" class="form-control" name="produser" placeholder="Produser" value="{{$listfilm['produser']}}">
                      @error('produser')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi foto --}}
                     <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Foto</label>
                      <input type="file" class="form-control" name="foto" placeholder="Foto" value="{{ $listfilm->foto }}">
                      @error('foto')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Mengisi skor --}}
                    <div class="form-group">
                      <label for="listfilm_id" class="tw-text-white">Skor</label>
                      <input type="number" class="form-control" name="skor" placeholder="Skor" value="{{$listfilm['skor']}}">
                      @error('skor')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Memilih genre --}}
                    <div class="form-group">
                      <!-- <label for="exampleInputUsername1">Prodi</label> -->
                      <label for="genre_id" class="tw-text-white">Genre</label>
                      <select  class="form-control" name="genre_id" value="{{$listfilm['genre']}}">
                        <option value="">Pilih</option>
                        @foreach ($genre as $item)
                            <option {{$listfilm->genre_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                      </select>
                      @error('genre_id')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>

                    {{-- Memilih studio --}}
                    <div class="form-group">
                      <!-- <label for="exampleInputUsername1">Prodi</label> -->
                      <label for="studio_id" class="tw-text-white">Studio</label>
                      <select  class="form-control" name="studio_id" >
                        <option value="">Pilih</option>
                        @foreach ($studio as $item)
                            <option {{$listfilm->studio_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->nama}}</option>
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
                                <option {{$listfilm->jenis_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->nama }}</option>
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
                            <option {{$listfilm->rating_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->rating}}</option>
                        @endforeach
                      </select>
                      @error('rating_id')
                        <label for="" class="text-danger">{{$message}}</label>
                       @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Simpan</button>
                    <a href="{{route('listfilm.index')}}" class="btn btn-outline-danger btn-sm">Cancel</a>
                  </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
