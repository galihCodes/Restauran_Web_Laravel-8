@extends('Dashboard.dash')

@section('tittle2', 'Proses Pembayaran')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('this')
    <a type="button" href="/restauran/pembayaran" class="btn btn-sm btn-outline-secondary">
        <span data-feather="arrow-left-circle"></span>
        Kembali
    </a>
@endsection
@section('content')
@foreach ($join as $item)
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
@endif
<form action="/restauran/{{ $item->id_order }}/struk" method="POST">
    @endforeach
    @csrf
    <div style="display: flex">
    <div class="card col-7" style="margin-right: 2rem; height: fit-content;">
        <div class="card-header" style="font-size: 16px">
            <span data-feather="menu" style="margin-bottom: 1px"></span>   <strong>Daftar Pesanan</strong>
        </div>
        <div class="card-body ">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                      <tr>
                          <th scope="col" style="vertical-align: middle; width: 60px;">No</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Nama</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Jumlah</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Jenis Menu</th>
                      </tr>
                    </thead>
                    @foreach ($detail as $item)
                    <tbody style="text-align: center;">
                        <tr>
                            <td scope="col">{{ $loop->iteration }}</td>
                            <td scope="col">{{ $item->nama_menu }}</td>
                            <td scope="col">{{ $item->sum }}</td>
                            <td scope="col">{{ $item->jenis_menu }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                  </table>
                </div>
            </div>
            <div class="card col-3" style="margin-left: 1rem;">
                <div class="card-header" style="font-size: 16px">
                    <span data-feather="info" style="margin-bottom: 1px"></span>       <strong>Transaksi Pembayaran</strong>
                </div>
                <div class="card-body">
                    @foreach ($join as $item)
                        <fieldset disabled>
                            <div class="mb-3">
                              <label for="" class="form-label" style="font-size: 15px">Nomor Meja</label>
                              <input type="text" class="form-control" id="" style="background-color: #e9ecef" name="nomor_meja" value="{{ $item->no_meja }}">
                            </div>
                        </fieldset>
                        <fieldset disabled>
                            <div class="mb-3">
                              <label for="" class="form-label" style="font-size: 15px">Id Order</label>
                              <input type="text" class="form-control" id="" style="background-color: #e9ecef" name="id_order" value="{{ $item->id_order }}">
                            </div>
                        </fieldset>
                        <fieldset disabled>
                            <div class="mb-3">
                              <label for="" class="form-label" style="font-size: 15px">Total Bayar</label>
                              <input type="text" class="form-control" id="" style="background-color: #e9ecef" name="totalbayar" value="Rp {{ number_format($item->total, 2, ',', '.') }}">
                            </div>
                        </fieldset>
                        <div class="mb-3">
                            <label for="tunai" class="form-label" style="font-size: 15px">Bayar (Rp)</label>
                            <input type="number" min="{{ $total }}" class="form-control" id="" style="background-color: #e9ecef" required name="tunai">
                        </div>
                        <div class="d-flex">
                            <button type="submit" style="width: 100%" onclick="return confirm('Wanna to Pay?')" class="btn btn-success btn-sm"><span data-feather="check-circle" style="margin-bottom: 0px"></span>   Bayar</button>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
        </form>
@endsection