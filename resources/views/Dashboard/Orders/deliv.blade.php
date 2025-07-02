@extends('Dashboard.dash')

@section('tittle2')
    <div align="left">
        <h6 class="mt-2">
            <a href="/restauran" style="color: grey; text-decoration: none;">Home</a><span style="color: grey"> / </span><a href="/restauran/menu" style="color: grey; text-decoration: none;">Menu</a><span style="color: grey"> / </span><a href="/restauran/orders" style="color: grey; text-decoration: none;">Pesanan</a><span style="color: grey"> / </span><a href="" style="text-decoration: none">Deliver</a>
        </h6>
    </div>
@endsection

@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif

@section('cart')
    <div class="btn-group me-3 mt-1">
        <a href="/restauran/orders"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="arrow-left-circle"  style="margin-bottom: 1px"></span>   Kembali</button></a>
    </div>
@endsection

@section('create')
<form action="/restauran/orders/save">
    <div class="btn-group me-3 mt-1">
        <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="download"  style="margin-bottom: 1px"></span>   Simpan Semua</button>
    </div>
</form>
@endsection

@section('this')
<form action="/restauran/orders/deliver">
    <div class="input-group">
      <input type="search" class="form-control" aria-describedby="search-addon" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
      <button type="submit" class="btn btn-primary ">
        Search
      </button>
    </div>
  </form>
@endsection
@section('content')
    <div class="card">
        <div class="card-header" style="font-size: 16px">
            <span data-feather="calendar" style="margin-bottom: 1px"></span>   <strong>Daftar Pesanan</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead style="text-align: center;">
                  <tr>
                      <th scope="col" style="vertical-align: middle; width: 60px;">No</th>
                      <th scope="col" style="vertical-align: middle; width: 60px;">Id Pesanan</th>
                      <th scope="col" style="vertical-align: middle; width: 60px;">No Meja</th>
                      <th scope="col" style="vertical-align: middle; width: 60px;">Status</th>
                      <th scope="col" style="vertical-align: middle; width: 60px;">Tanggal</th>
                      <th scope="col" style="vertical-align: middle; width: 60px;"></th>
                  </tr>
                </thead>
                @forelse ($order as $item)
                @if ($item->status == 'sudah diantar')
                <tbody style="text-align: center;">
                    <tr>
                        <td scope="col">{{ $loop->iteration }}</td>
                        <td scope="col">{{ $item->id_order }}</td>
                        <td scope="col">{{ $item->no_meja }}</td>
                        <td scope="col" class="col-2">
                            <label for="" style="color: white; padding-bottom: 2px; padding-top: 2px;" class="btn btn-success btn-sm">sudah diantar</label>
                        </td>
                        <td scope="col">{{ $item->tanggal }}</td>
                        <td scope="col" class="col-2">
                            <form action="/restauran/{{ $item->id_order }}/hidden" method="POST">
                                @csrf
                                <button class="btn btn-info" style="padding-bottom: 2px; padding-top: 2px;color: white">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @endif
                    @empty
                        <tr>
                            <td colspan="6" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                        </tr>
                    </tbody>
                    {{-- <input type="hidden" name="id_order" id="" value="{{ $item->id }}"> --}}
                @endforelse
              </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4 mb-5" style="margin-left: 9rem">
        {{ $order->links() }}
    </div> 
@endsection