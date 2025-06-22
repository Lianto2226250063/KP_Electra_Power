@extends('layouts.main')
@section('title', 'Home')
@section('content')

<div class="container">
    <div class="container mb-3">
        <div class="row align-items-end">
            <!-- Kolom kiri: Tambah -->
            <div class="col-md-4">
                <a href="{{ route('invoice.create') }}" class="btn btn-success">Tambah Invoice</a>
            </div>

            <!-- Kolom kanan: Filter -->
            <div class="col-md-8">
                <form action="{{ route('invoice.index') }}" method="GET" class="row g-2 justify-content-end align-items-end">
                    <div class="col-md-auto">
                        <input type="text" name="search" class="form-control" placeholder="Cari invoice..." value="{{ request('search') }}">
                    </div>
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
                    <div class="col-md-auto">
                        <input type="number" name="tahun" class="form-control" placeholder="Tahun" min="2000" value="{{ request('tahun') }}">
                    </div>
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
                    <th></th>
                    <th>Nomor</th>
                    <th>Tempat & Tanggal Penjualan</th>
                    <th>Kepada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($invoice as $item)
                <tr>                      
                    <td>
                        <button class="btn btn-outline-dark btn-sm toggle-detail" data-id="{{ $item->id }}">
                            <span class="toggle-icon" id="icon-{{ $item->id }}">▼</span>
                        </button>
                    </td>  
                    <td>{{ $item->nomor ?? '-' }}</td>
                    <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                    <td>{{ $item->kepada ?? '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">                           
                            <a href="{{ route('invoice.download', $item->id) }}" class="btn btn-outline-warning btn-sm">Download PDF</a>
                            <a href="{{ route('invoice.print', $item->id) }}" class="btn btn-outline-primary btn-sm">Print</a>
                            @if (Auth::user()->name === $item->pegawai->name || Auth::user()->role === 'admin')
                                <a href="{{ route('invoice.edit', $item->id) }}" class="btn btn-outline-success btn-sm">Edit</a>
                            @endif
                            @if (Auth::user()->role === 'admin')
                                <form method="POST" action="{{ route('invoice.destroy', $item->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-nama='{{ $item->nomor }}'>Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>

                {{-- Detail Row --}}
                <tr class="invoice-detail-row d-none" id="detail-{{ $item->id }}" style="background-color: #f9f9f9;">
                    <td colspan="4" class="text-start">
                        <strong>Detail Invoice:</strong>
                        @if ($item->details && $item->details->count())
                            <ul class="mb-0 mt-2">
                                @foreach ($item->details as $detail)
                                    <li>
                                        {{ $detail->keterangan }} - {{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                        = <strong>Rp {{ number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.') }}</strong>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mt-2">Tidak ada detail.</p>
                        @endif
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

{{-- Toggle Detail Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-detail').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const row = document.getElementById('detail-' + id);
                const icon = document.getElementById('icon-' + id);

                row.classList.toggle('d-none');

                const isHidden = row.classList.contains('d-none');
                icon.textContent = isHidden ? '▼' : '▲';
            });
        });
    });
</script>
@endsection
