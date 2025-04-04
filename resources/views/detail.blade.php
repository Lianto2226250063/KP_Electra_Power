@extends('layouts.main')
@section('title', 'detail')
@section('content')
<div class="container bg-dark tw-pb-5">
    <h1 class ="text-light">{{$jual->nama}}</h1>
    <div class="tw-flex tablet:tw-flex-col">
        <div class="image tablet:tw-w-full tablet:tw-flex tablet:tw-justify-center">
            <img src="images/{{$jual->foto}}" alt="" width="329" height="329">
        </div>
        <div class="container" style="margin-left: 10px">
            <p class="text-light" style="text-align: left">{{$jual->deskripsi}}</p>
            <div class="tw-flex-col">
                <div class="">
                    <h4 class="text-light" style="padding-right: 5px">Toko: {{$jual->toko}}</h4>
                </div>
                <div class="">
                    <h4 class="text-light" style="padding-right: 5px">Penjual: {{$jual->penjual}}</h4>
                </div>
                <div class="">
                    <h4 class="text-light" style="padding-right: 5px">Harga: Rp {{number_format($jual->harga, 0, ',', '.')}}</h4>
                </div>
            </div>
            @if (Auth::user()->name == $jual->penjual || Auth::user()->role == 'A')
            <div class="tw-flex">
                <a href="{{ route('jual.edit', ['jual'=>$jual]) }}">
                    <button class="btn btn-success btn-rounded btn-sm mx-3">Edit</button>
                </a>
                <form method="POST" action="{{ route('jual.destroy', ['jual'=>$jual]) }}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-rounded btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $jual->nama }}'>Delete</button>
                </form>
            </div>
            @endif
            @if (Auth::user()->name != $jual->penjual)
            <div class="tw-flex">
                <a href="{{ route('beli.create', ['jual'=>$jual]) }}">
                    <button class="btn btn-success btn-rounded btn-sm mx-3">Pesan</button>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
