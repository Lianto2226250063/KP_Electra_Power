@extends('layouts.main')
@section('title','Genre')

@section('content')
<h1 style="color: white">Halaman Genre</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
            <h4 class="card-title" style="color: white">Genre</h4>
            <p class="card-description" style="color: white">Daftar Genre Film</p>

                <div class="table-responsive">
                    <table class="table table-dark">
                        <tr>
                            <th>Nama Genre</th>
                            @if (Auth::user()->role == 'A')
                                <th>Aksi</th>
                            @endif
                        </tr>
                        @foreach ($genre as $item)
                        <tr>
                            <td><a href="{{route('genre.show', ['id' => $item->id])}}" class="!tw-text-white">{{$item->nama}}</a></td>
                            @if (Auth::user()->role == 'A')
                                <td>
                                    <div class="d-flex">
                                    <a href="{{ route('genre.edit', $item->id) }}">
                                        <button class="btn btn-success btn-rounded btn-sm mx-3">Edit</button>
                                    </a>
                                    <form method="POST" action="{{ route('genre.destroy', $item->id) }}">
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
