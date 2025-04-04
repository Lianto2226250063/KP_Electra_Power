@extends('layouts.main')
@section('title', 'Home')
@section('content')
<div class="container text-center">
  <div class="tw-grid tw-grid-cols-[repeat(auto-fill,minmax(200px,1fr))] tw-gap-5">
    @foreach ($jual as $item)
    <div class="col-6">
      <div class="p-3">
        <div class="container" style="flex-column">
          <div class="movie">
            <div class="movie-image">
              <span class="play">
                <a href="{{route('jual.show', ['jual' => $item])}}"><span class="name">View Details</span></a>
              </span>
              <a href="{{route('jual.show', ['jual' => $item])}}"><img src="{{($item['foto'] == '') ? 'imagenotfound.png' : asset('images/'.$item['foto'])}}" alt="images/imagenotfound.png"/></a>
              <span class="name">{{$item['nama']}}<br>{{$item['toko']}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

@endsection
