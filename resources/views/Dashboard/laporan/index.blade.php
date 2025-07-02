@extends('Dashboard.dash')

@section('tittle2', 'Laporan')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif

@section('cart')
<div class="btn-group me-3 mb-1 mt-1">
  <button type="button"  data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-sm btn-outline-secondary"><span data-feather="printer" style="margin-bottom: 1px; margin-right: 3px"></span>Cetak</button>
</div>
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cetak Laporan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/restauran/laporan/cetak" method="POST">
            @csrf
          <div class="modal-body">
                <div class="mb-3">
                  <label for="" class="form-label">Tanggal Awal</label>
                  <input type="date" class="form-control" name="awal" required>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Tanggal Akhir</label>
                  <input type="date" class="form-control" id="" min="" name="akhir" required>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><span data-feather="send"></span> Cetak</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection

@section('this')
  <form action="/restauran/laporan">
    <div class="input-group">
      <input type="search" class="form-control" aria-describedby="search-addon" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
      <button type="submit" class="btn btn-primary ">
        Search
      </button>
    </div>
  </form>
@endsection

@section('content')
<div class="container">
    <div class="card" style="height: 100%">
      <div class="card-header" style="font-size: 16px">
          <span data-feather="sliders" style="margin-bottom: 2px; margin-right: 7px;"></span><strong>Data Penjualan</strong>
          <span class="d-flex justify-content-end" style="margin-top: -15px; font-size: 14px; margin-right: 4px">
                <b>Total Penjualan : Rp {{ number_format($sum, 2, ',', '.') }}</b>
          </span>
      </div>
      <div class="card-body">
      <table class="table table-bordered table-hover " border="1" style="border-color: rgb(226, 224, 224)">
          <thead style="text-align: center;">
            <tr class="table-light table-secondary">
                <th scope="col" style="vertical-align: middle; width: 60px;">Id Transaksi</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Tanggal</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Total Bayar</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Id Kasir</th>
                <th scope="col" style="vertical-align: middle; width: 60px;"></th>
            </tr>
          </thead>
          <tbody style="text-align: center;">
            @foreach ($join as $item)
                  <tr>
                      <td scope="col">{{ $item->id_transaksi }}</td>
                      <td scope="col">{{ $item->tanggal }}</td>
                      <td scope="col">Rp {{ number_format($item->total_bayar, 0, ',', '.')}}</td>
                      <td scope="col">{{ $item->id_user }}</td>
                      <td scope="col">
                        <a href="/restauran/laporan/{{ $item->id_order }}/detail" class="btn btn-success"><span data-feather="search" style="margin-bottom: 0.1rem; margin-right: 5px"></span>Detail</a>
                      </td>
                  </tr>
                  @endforeach
                  @if (!$join->count())
                    <tr>
                      <td colspan="5" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                    </tr>
                  @endif
            </tbody>
        </div>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center mt-4 mb-5">
    {{ $join->links() }}
</div>  
@endsection