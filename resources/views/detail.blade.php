@extends('layouts.main')
@section('title', 'detail')
@section('content')
<div class="container bg-dark tw-pb-5">
    <h1 class ="text-light">{{$listfilm->nama}}</h1>
    <div class="tw-flex tablet:tw-flex-col">
        <div class="image tablet:tw-w-full tablet:tw-flex tablet:tw-justify-center">
            <img src="images/{{$listfilm->foto}}" alt="" width="329" height="500">
        </div>
        <div class="container" style="margin-left: 10px">
            <p class="text-light" style="text-align: left">{{$listfilm->deskripsi}}</p>
            <div class="tw-flex-col">
                <div class="">
                    <h4 class="text-light" style="padding-right: 5px">Genre: {{$listfilm->genre['nama']}}</h4>
                </div>
                <div class="">
                    <h4 class="text-light" style="padding-right: 50px">Jenis: {{$listfilm->jenis['nama']}}</h4>
                </div>
                <div class="">
                    <h4 class="text-light" style="padding-right: 5px">Studio: {{$listfilm->studio['nama']}}</h4>
                </div>
            </div>
            <div class="tw-flex">
                <img src="{{asset('images/star.png')}}" width="30px" height="30px">
                <h2 class="text-light" style="margin-left: 10px">{{$listfilm->skor}}</h2>
            </div>
            @if (Auth::user()->role == 'A')
            <div class="tw-flex">
                <a href="{{ route('listfilm.edit', ['listfilm'=>$listfilm]) }}">
                    <button class="btn btn-success btn-rounded btn-sm mx-3">Edit</button>
                </a>
                <form method="POST" action="{{ route('listfilm.destroy', ['listfilm'=>$listfilm]) }}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-rounded btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $listfilm->nama }}'>Delete</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
