@extends('layouts.main')
@section('title','Jual')

@section('content')
<h1 style="color: white">Daftar Pemesanan</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Pemesanan</h4>
                <p class="card-description" style="color: white">Data Pemesanan makanan</p>

                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Makanan</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($jual as $item)
                            @if (Auth::user()->name == $item->penjual || Auth::user()->role == 'A')
                                <tr>
                                    <td>
                                        <a href="{{ route('jual.show', $item->id) }}" class="!tw-text-white">
                                            <img src="/images/{{$item->foto}}" alt="" width="100" height="100">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('jual.show', $item->id) }}" class="!tw-text-white">
                                            {{ $item->nama ?? '-' }}
                                        </a>
                                    </td>
                                    <td>{{ $item->deskripsi ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') ?? '-'}}</td>
                                    @if (Auth::user()->role == 'A'|| Auth::user()->name == $item->penjual)
                                        <td>
                                            <div class="d-flex">
                                                <form method="POST" action="{{ route('beli.destroy', $item->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-rounded btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $item->nama }}'>Batalkan Penjualan</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
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
