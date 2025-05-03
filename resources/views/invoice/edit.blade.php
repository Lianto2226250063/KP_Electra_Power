@extends('layouts.main')

@section('title', 'Edit Invoice')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" 
          @php
          $details = old('keterangan') 
              ? collect(old('keterangan'))->map(function ($k, $i) {
                  return [
                      'keterangan' => $k,
                      'jumlah' => old('jumlah')[$i] ?? '',
                      'harga_satuan' => old('harga_satuan')[$i] ?? '',
                  ];
              }) 
              : ($invoice->items ?? collect())->map(function ($item) {
              return [
                  'keterangan' => $item->keterangan,
                  'jumlah' => $item->jumlah,
                  'harga_satuan' => $item->harga_satuan,
              ];
            });
      
          $jsonDetails = htmlspecialchars(json_encode($details), ENT_QUOTES, 'UTF-8');
      @endphp
      
      <div class="card" x-data="{ details: {!! $jsonDetails !!} }">
        
            <div class="card-body bg-dark rounded">
                <h4 class="card-title text-white text-4xl text-center">Edit Invoice</h4>
                <p class="card-description text-white text-xl">Perbarui data invoice</p>
                <br>
                <form class="forms-sample" method="POST" action="{{ route('invoice.update', $invoice->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="nomor" class="text-white">Nomor Invoice</label>
                        <input type="text" class="form-control" name="nomor" value="{{ old('nomor', $invoice->nomor) }}" required>
                        @error('nomor')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kepada" class="text-white">Kepada</label>
                        <input type="text" class="form-control" name="kepada" value="{{ old('kepada', $invoice->kepada) }}" required>
                        @error('kepada')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal" class="text-white">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $invoice->tanggal) }}" required>
                        @error('tanggal')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi" class="text-white">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $invoice->lokasi) }}" required>
                        @error('lokasi')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <br>
                    <h4 class="text-white text-xl">Detail Invoice</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered text-white">
                            <thead>
                                <tr>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Harga Satuan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(detail, index) in details" :key="index">
                                    <tr>
                                        <td>
                                            <textarea class="form-control" x-model="details[index].keterangan" :name="'keterangan['+index+']'" required></textarea>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="details[index].jumlah" :name="'jumlah['+index+']'" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" x-model="details[index].harga_satuan" :name="'harga_satuan['+index+']'" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" @click="details.splice(index, 1)" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" @click="details.push({ keterangan: '', jumlah: '', harga_satuan: '' })" class="btn btn-outline-primary btn-sm tw-m-3">Tambah Detail</button>
                    <br><br>
                    <button type="submit" class="btn btn-outline-success btn-sm tw-m-3">Simpan Perubahan</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-danger btn-sm">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
