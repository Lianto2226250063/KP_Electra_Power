@extends('layouts.main')
@section('title','Tambah Beli')

@section('content')
<h1 style="color: white">Halaman Pemesanan</h1>
<div class="row">
    <div class="col-lg-12 grid-margin strech-card">
        <div class="card">
            <div class="card-body bg-dark">
                <div class="image tablet:tw-w-full tablet:tw-flex tablet:tw-justify-center">
                    <img src="/images/{{$jual->foto}}" alt="" width="329" height="329">
                </div> 
                <form class="forms-sample" method="POST" action="{{route('beli.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="catatan" class="tw-text-white">Catatan untuk penjual</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required placeholder="Type here..."></textarea>
                        @error('catatan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="durasi" class="tw-text-white">Durasi (Tanggal)</label>
                        <input type="date" class="form-control" id="durasi" name="durasi" required>
                        @error('durasi')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="tw-text-white">Alamat Pengantaran Makanan</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Type here...">
                        @error('alamat')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah" class="tw-text-white">Jumlah Pemesanan</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required placeholder="Type here...">
                    </div>
                    <input type="hidden" name="jual_id" value="{{ $jual->id }}">
                    <input type="hidden" name="foto" value="{{ $jual->foto }}">
                    <br>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Submit</button>
                    <a href="{{ url('home') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
