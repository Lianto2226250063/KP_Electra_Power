@extends('layouts.main')

@section('title', 'Ubah Password')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body rounded">
            <h4 class="card-title text-4xl text-center">Ubah Password</h4>
            <br>
            <form method="POST" action="{{ route('edit') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="password">Password Lama</label>
                    <input type="password" name="password" class="form-control " />
                    @error('password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" name="password" class="form-control " />
                    @error('password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control " />
                    @error('password_confirmation')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <button type="button" class="btn btn-outline-success btn-sm tw-m-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Ubah</button>
                <a href="/user/index" class="btn btn-outline-danger btn-sm">Batal</a>
                <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Ubah Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengubah password akun ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ya</button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
