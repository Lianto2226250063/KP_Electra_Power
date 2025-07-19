@extends('layouts.main')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="container mb-3">
        <div class="row align-items-end">
            <div class="col-md-4">
                <a href="{{ route('barang.create') }}" class="btn btn-success">
                    Tambah Barang & Jasa
                </a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('barang.index') }}" method="GET" class="row g-2 justify-content-end align-items-end">
                    <div class="col-md-auto">
                        <select name="jenis" class="form-select">
                            <option value="">Jenis</option>
                            <option value="Barang" {{ request('jenis') == 'Barang' ? 'selected' : '' }}>Barang</option>
                            <option value="Jasa" {{ request('jenis') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                            <option value="Lainnya" {{ request('jenis') == 'Jasa' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <input type="text" name="search" class="form-control" placeholder="Cari barang/jasa" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
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
                    <th>
                        {{ request('jenis') === 'Barang' ? 'Barang' : (request('jenis') === 'Jasa' ? 'Jasa' : 'Barang atau Jasa') }}
                    </th>
                    <th>Harga</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                <tr>
                    <td>{{ $item->id ?? '-' }}</td>
                    <td class="text-left">{{ $item->nama }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-outline-success btn-sm mr-2">Edit</a>
                            <form method="POST" action="{{ route('barang.destroy', $item->id) }}" class="form-delete">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-outline-danger btn-sm btn-delete"
                                    data-nama="{{ $item->nama }}" data-id="{{ $item->id }}">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $barang->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data barang/jasa <strong id="deleteInvoiceName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let formToSubmit = null;

        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function () {
                const nama = this.dataset.nama;
                document.getElementById('deleteInvoiceName').textContent = nama;

                formToSubmit = this.closest('form');

                const modal = new bootstrap.Modal(document.getElementById('modalDelete'));
                modal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    });
</script>
@endsection
