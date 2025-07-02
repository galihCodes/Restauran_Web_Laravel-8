@extends('Dashboard.dash')

@section('tittle2', 'Proses Order')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('this')
    <a type="button" href="/restauran/menu" class="btn btn-sm btn-outline-secondary">
        <span data-feather="arrow-left-circle"></span>
        Kembali
    </a>
@endsection
@section('content')
<form action="/restauran/orders" method="POST">
    @csrf
    <div class="card col-3" style="float: left; margin-right: 2rem;">
        <div class="card-header" style="font-size: 16px">
            <span data-feather="info" style="margin-bottom: 1px"></span>       <strong>Data Order</strong>
        </div>
        <div class="card-body">
                <fieldset disabled>
                    <div class="mb-3">
                      <label for="" class="form-label" style="font-size: 15px">Nama Kasir</label>
                      <input type="text" class="form-control" id="" style="background-color: #e9ecef" name="name" value="{{ auth()->user()->full_name }}">
                    </div>
                </fieldset>
                <div class="mb-3">
                  <label for="" class="form-label" style="font-size: 15px">Nomor Meja</label>
                  <div class="mb-3">
                    <select name="nomor_meja" id="nomor_meja" class="form-select" required style="background-color: #e9ecef; font-size: 14px;">
                      <option value="" selected hidden >-- No. Meja --</option>
                      @foreach ($meja as $item)
                      <option name="nomor_meja" value="{{ $item->Nomor_Meja }}">{{ $item->Nomor_Meja }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <fieldset disabled>
                    <div class="mb-3">
                      <label for="" class="form-label" style="font-size: 15px">Tanggal</label>
                      <input type="text" class="form-control" id="" style="background-color: #e9ecef" name="tanggal" value="{{ $date }}">
                    </div>
                </fieldset>
                <div class="d-flex">
                    <a href="/restauran/orders/batal" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" style="margin-bottom: 0" ></span>   Batal</a>
                    @if (count($join) == 0 )
                    <a  style="cursor: not-allowed"  class="btn btn-secondary btn-sm"><span data-feather="slash" style="margin-bottom: 0px"></span>   Order</a>
                    @else
                    <button type="submit" class="btn btn-primary btn-sm"><span data-feather="check-circle" style="margin-bottom: 0px"></span>   Order</button>
                    @endif
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="font-size: 16px">
            <span data-feather="menu" style="margin-bottom: 1px"></span>   <strong>Daftar Menu</strong>
        </div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                      <tr>
                          <th scope="col" style="vertical-align: middle; width: 60px;">No</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Nama</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Harga</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Jumlah</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;">Subtotal</th>
                          <th scope="col" style="vertical-align: middle; width: 60px;"></th>
                      </tr>
                    </thead>
                    @forelse ($join as $item)
                        <tbody style="text-align: center;">
                            <tr>
                                <td scope="col">{{ $loop->iteration }}</td>
                                <td scope="col">{{ $item->nama_menu }}</td>
                                <td scope="col">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td scope="col">{{ $item->jumlah }}</td>
                                <td scope="col">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td scope="col">
                                    <a href="/restauran/orders/{{ $item->id }}/hapus" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center" style="color: gray">Tidak ada Menu di Tabel</td>
                            </tr>
                        </tbody>
                        <input type="hidden" name="id_order" id="" value="{{ $item->id }}">
                    @endforelse
                    @if (count($join) != 0)
                    <tr>
                        <td colspan="6" ><strong style="margin-left: 12rem">Total : Rp. {{ number_format($total, 2, ',', '.') }}</strong></td>
                    </tr>   
                    @endif
                  </table>
                </div>
            </div>
        </form>
@endsection