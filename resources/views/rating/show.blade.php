@extends('layouts.main')
@section('title', 'Search Rating')
@section('content')
<div class="container text-center">
    <h2 class='tw-text-white'>Rating : {{$rating['rating']}}</h2>
  <div class="tw-grid tw-grid-cols-[repeat(auto-fill,minmax(200px,1fr))] tw-gap-5">
    @foreach ($listfilm as $item)
    <div class="col-6">
      <div class="p-3">
        <div class="container" style="flex-column">
          <div class="movie">
            <div class="movie-image">
              <span class="play">
                <a href="{{route('listfilm.show', ['listfilm' => $item])}}"><span class="name">View Details</span></a>
              </span>
              <a href="{{route('listfilm.show', ['listfilm' => $item])}}"><img src="{{($item['foto'] == '') ? 'imagenotfound.png' : asset('images/'.$item['foto'])}}" alt="images/imagenotfound.png"/></a>
              <span class="name">{{$item['nama']}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

@endsection