@extends('layouts.main')

@section('title', 'Ubah Password')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body rounded">
            <h4 class="card-title text-4xl text-center">Ubah Password</h4>
            
            {{-- ✅ Notifikasi sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- ✅ Notifikasi error global --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <br>

            {{-- ✅ Form ubah password untuk user login --}}
            <form method="POST" action="{{ route('user.password.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- Password Lama --}}
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="current_password">Password Lama</label>
                    <input 
                        type="password" 
                        name="current_password" 
                        class="form-control" 
                        placeholder="Masukkan password lama"
                    />
                    @error('current_password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="new_password">Password Baru</label>
                    <input 
                        type="password" 
                        name="new_password" 
                        class="form-control" 
                        placeholder="Minimal 6 karakter"
                    />
                    @error('new_password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input 
                        type="password" 
                        name="new_password_confirmation" 
                        class="form-control" 
                        placeholder="Ulangi password baru"
                    />
                </div>

                {{-- Tombol dengan konfirmasi modal --}}
                <button 
                    type="button" 
                    class="btn btn-outline-success btn-sm tw-m-3" 
                    data-bs-toggle="modal" 
                    data-bs-target="#konfirmasiModal">
                    Ubah
                </button>
                <a href="{{ route('user.index') }}" class="btn btn-outline-danger btn-sm">Batal</a>

                {{-- Modal Konfirmasi --}}
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
                                <button type="submit" class="btn btn-success">Ya, Ubah Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
