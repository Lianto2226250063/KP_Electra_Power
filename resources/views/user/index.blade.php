@extends('layouts.main')
@section('title', 'Daftar Pengguna')
@section('content')
<div class="container">
    <div class="container mb-3">
        <div class="row align-items-end">
            <!-- Kolom kiri: Tombol Tambah User -->
            <div class="col-md-4">
                @auth
                @if (Auth::user()->role === 'admin')
                <a href="{{ route('register') }}" class="btn btn-success">Tambah Pengguna</a>
                @endif
                @endauth
            </div>
            <!-- Kolom kanan: Form Filter -->
            <div class="col-md-8">
                <form action="{{ route('user.index') }}" method="GET" class="row g-2 justify-content-end align-items-end">
                    <!-- Search -->
                    <div class="col-md-auto">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama/email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive text-center rounded">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            @auth
                            @if (Auth::user()->role === 'admin')
                            <form action="{{ route('user.toggleStatus', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-success' : 'btn-secondary' }}">
                                    {{ ucfirst($user->status) }}
                                </button>
                            </form>  
                            @elseif (Auth::user()->role === 'user')
                            {{ ucfirst($user->status) }}
                            @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
