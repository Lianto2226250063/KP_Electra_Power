@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="container mb-3">
            <div class="row align-items-end">
                <!-- Kolom kiri: Tombol Tambah Invoice -->
                <div class="col-md-4">
                    <a href="{{ route('invoice.create') }}" class="btn btn-success">
                        Tambah Invoice
                    </a>
                </div>
                <!-- Kolom kanan: Form Filter -->
                <div class="col-md-8">
                    <form action="{{ route('invoice.index') }}" method="GET" class="row g-2 justify-content-end align-items-end">
                        <!-- Search -->
                        <div class="col-md-auto">
                            <input type="text" name="search" class="form-control" placeholder="Cari invoice..." value="{{ request('search') }}">
                        </div>
                        <!-- Bulan -->
                        <div class="col-md-auto">
                            <select name="bulan" class="form-control">
                                <option value="">-- Bulan --</option>
                                @foreach(range(1, 12) as $b)
                                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tahun -->
                        <div class="col-md-auto">
                            <select name="tahun" class="form-control">
                                <option value="">-- Tahun --</option>
                                @foreach(range(now()->year, 2020) as $t)
                                    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                                        {{ $t }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tombol Filter dan Reset -->
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('invoice.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive text-center rounded">
          <table class="table">
              <thead>
                  <tr>
                      <th>Nomor</th>
                      <th>Tempat & Tanggal Penjualan</th>
                      <th>Kepada</th>
                      {{-- <th>Pegawai</th> --}}
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($invoice as $item)
                    <tr>                        
                        <td>{{ $item->nomor ?? '-' }}</td>
                        <td>{{ $item->lokasi }}, {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                        <td>{{ $item->kepada ?? '-' }}</td>
                        {{-- <td>{{ $item->pegawai->name ?? '-' }}</td> --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('invoice.download', $item->id) }}" class="btn btn-outline-warning btn-sm mr-2">Download PDF</a>
                                <a href="{{ route('invoice.print', $item->id) }}" class="btn btn-outline-primary btn-sm mr-2">Print</a>
                                @if (Auth::user()->name === $item->pegawai->name || Auth::user()->role === 'admin')
                                    <a href="{{ route('invoice.edit', $item->id) }}" class="btn btn-outline-success btn-sm mr-2">Edit</a>
                                @endif
                                @if (Auth::user()->role === 'admin')
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
            <div class="d-flex justify-content-center mt-3">
                {{ $invoice->links() }}
            </div>
      </div>
    </div>
</div>

@endsection
