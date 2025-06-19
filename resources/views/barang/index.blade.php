@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="container mb-3">
            <div class="row align-items-end">
                <!-- Kolom kiri: Tombol Tambah barang -->
                <div class="col-md-4">
                    <a href="{{ route('barang.create') }}" class="btn btn-success">
                        Tambah Barang & Jasa
                    </a>
                </div>
                <!-- Kolom kanan: Form Filter -->
                <div class="col-md-8">
                    <form action="{{ route('barang.index') }}" method="GET" class="row g-2 justify-content-end align-items-end">
                        <!-- Search -->
                        <div class="col-md-auto">
                            <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request('search') }}">
                        </div>
                        <!-- Tombol Filter dan Reset -->
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive text-center rounded">
          <table class="table">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Barang atau Jasa</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($barang as $item)
                    <tr>                        
                        <td>{{ $item->id ?? '-' }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-outline-success btn-sm mr-2">Edit</a>
                                @endif
                                @if (Auth::user()->role === 'admin')
                                    <form method="POST" action="{{ route('barang.destroy', $item->id) }}">
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
            <div class="d-flex justify-content-center mt-3">
                {{ $barang->links() }}
            </div>
      </div>
    </div>
</div>

@endsection
