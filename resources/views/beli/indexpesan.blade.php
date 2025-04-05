@extends('layouts.main')
@section('title','Jual')

@section('content')
<h1 style="color: white">Daftar Penjualan</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <h4 class="card-title" style="color: white">Penjualan</h4>
                <p class="card-description" style="color: white">Data Penjualan makanan</p>

                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Nama Makanan</th>
                                <th>Nama pembeli</th>
                                <th>Durasi</th>
                                <th>Alamat</th>
                                <th>Catatan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($beli as $item)
                            @if (Auth::user()->name == $item->jual->penjual || Auth::user()->role == 'A')
                                <tr>
                                    <td>
                                        <a href="{{ route('jual.show', $item->jual_id) }}" class="!tw-text-white">
                                            {{ $item->jual->nama ?? '-' }}
                                        </a>
                                    </td>
                                    <td>{{ $item->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->durasi)->format('d M Y') }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->catatan }}</td>
                                    <td>{{ $item->jumlah }}</td>

                                    @if (Auth::user()->role == 'A'|| Auth::user()->name == $item->jual->penjual)
                                        <td>
                                            <div class="d-flex">
                                                <form method="POST" action="{{ route('beli.destroy', $item->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-rounded btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $item->jual->nama }}'>Batalkan Pesanan</button>
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