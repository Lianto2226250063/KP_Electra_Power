@extends('layouts.main')

@section('title', 'Tambah Invoice')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body rounded">
            <h4 class="card-title text-4xl text-center">Buat Akun</h4>
            <p class="card-description text-xl">Masukkan data pegawai</p>
            <br>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" name="name" class="form-control " />
                    @error('name')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control " />
                    @error('email')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="password">Password</label>
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
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="ttd">Upload TTD (Image)</label>
                    <input type="file" name="ttd" class="form-control " accept="image/*" />
                    @error('ttd')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="role">Role</label>
                    <select name="role" class="form-control ">
                        <option value="" disabled selected>Select Role</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <button type="button" class="btn btn-outline-success btn-sm tw-m-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Submit</button>
                <a href="/user/index" class="btn btn-outline-danger btn-sm">Cancel</a>
                <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Submit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin membuat akun ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ya, Submit</button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
