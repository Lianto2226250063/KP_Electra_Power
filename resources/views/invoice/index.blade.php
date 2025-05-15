@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="table-responsive text-center rounded">
          <table class="table table-dark ">
              <thead>
                  <tr>
                      <th>Nomor</th>
                      <th>Tempat & Tanggal Penjualan</th>
                      <th>Kepada</th>
                      <th>Pegawai</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($invoice as $item)
                    <tr>                        
                        <td>{{ $item->nomor ?? '-' }}</td>
                        <td>{{ $item->lokasi }}, {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                        <td>{{ $item->kepada ?? '-' }}</td>
                        <td>{{ $item->pegawai->name ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('invoice.print', $item->id) }}" class="btn btn-outline-primary btn-sm mr-2">Print</a>
                                @if (Auth::user()->name === $item->pegawai->name || Auth::user()->role === 'admin')
                                    <a href="{{ route('invoice.edit', $item->id) }}" class="btn btn-outline-success btn-sm mr-2">Edit</a>
                                    <form method="POST" action="{{ route('invoice.destroy', $item->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-rounded btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $item->nama }}'>Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
              @endforeach
              </tbody>
          </table>
      </div>
    </div>
</div>

@endsection
