@extends('layouts.main')
@section('title','Studio')

@section('content')
<h1 class="tw-text-white">Halaman Studio</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
            <h4 class="card-title" style="color: white">Studio</h4>
            <p class="card-description tw-text-white">Daftar Studio Film</p>

                <div class="table-responsive">
                    <table class="table table-dark">
                        <tr>
                            <th>Nama Studio</th>
                            @if (Auth::user()->role == 'A')
                                <th>Aksi</th>
                            @endif
                        </tr>
                        @foreach ($studio as $item)
                        <tr>
                            <td><a href="{{route('studio.show', ['id' => $item->id])}}" class="!tw-text-white">{{$item->nama}}</a></td>
                            @if (Auth::user()->role == 'A')
                                <td>
                                    <div class="d-flex">
                                    <a href="{{ route('studio.edit', $item->id) }}">
                                        <button class="btn btn-success btn-rounded btn-sm mx-3">Edit</button>
                                    </a>
                                    <form method="POST" action="{{ route('studio.destroy', $item->id) }}">
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
