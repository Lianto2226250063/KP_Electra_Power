@extends('layouts.main')
@section('title','Rating')

@section('content')
<h1 style="color: white">Halaman Rating</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
            <h4 class="card-title" style="color: white">Rating</h4>
            <p class="card-description" style="color: white">Daftar Rating Film</p>

                <div class="table-responsive">
                    <table class="table table-dark">
                        <tr>
                            <th>Nama Rating</th>
                            @if (Auth::user()->role == 'A')
                                <th>Aksi</th>
                            @endif
                        </tr>
                        @foreach ($rating as $item)
                        <tr>
                            <td><a href="{{route('rating.show', ['id' => $item->id])}}" class="!tw-text-white">{{$item->rating}}</a></td>
                            @if (Auth::user()->role == 'A')
                                <td>
                                    <div class="d-flex">
                                    <a href="{{ route('rating.edit', $item->id) }}">
                                        <button class="btn btn-success btn-rounded btn-sm mx-3">Edit</button>
                                    </a>
                                    <form method="POST" action="{{ route('rating.destroy', $item->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-rounded btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $item->nama }}'>Delete</button>
                                    </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        @if (Session::get('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>
@endsection
