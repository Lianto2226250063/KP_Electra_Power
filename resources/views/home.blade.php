@extends('layouts.main')
@section('title', 'Home')
@section('content')
<div class="container text-center" style="background: -webkit-linear-gradient(to right, #286316, #49a02f, #7ab34c, #8efa79); min-height: 100vh; padding: 2rem;">
  <div class="tw-grid tw-grid-cols-[repeat(auto-fill,minmax(200px,1fr))] tw-gap-5">
    @foreach ($listfilm as $item)
    <div class="col-6">
      <div class="p-3">
        <div class="container" style="flex-direction: column;">
          <div class="movie">
            <div class="movie-image">
              <span class="play">
                <a href="{{route('listfilm.show', ['listfilm' => $item])}}"><span class="name">View Details</span></a>
              </span>
              <a href="{{route('listfilm.show', ['listfilm' => $item])}}">
                <img src="{{($item['foto'] == '') ? 'imagenotfound.png' : asset('images/'.$item['foto'])}}" alt="images/imagenotfound.png"/>
              </a>
              <span class="name">{{$item['nama']}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
