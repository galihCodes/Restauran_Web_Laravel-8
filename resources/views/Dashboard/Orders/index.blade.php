@extends('Dashboard.dash')

@section('tittle2')
    <div align="left">
        <h6 class="mt-2">
            <a href="/restauran" style="color: grey; text-decoration: none;">Home</a><span style="color: grey"> / </span><a href="/restauran/menu" style="color: grey; text-decoration: none;">Menu</a><span style="color: grey"> / </span><a href="" style="text-decoration: none">Pesanan</a>
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

@section('create')
    <div class="btn-group me-3 mt-1">
    <a href="/restauran/orders/deliver"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="upload"  style="margin-bottom: 2px"></span>   Diantar</button></a>
  </div>
@endsection

@section('this')
<form action="/restauran/orders">
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
            @foreach ($order as $item)
            @if ($item->status == 'sedang dimasak')
            <tbody style="text-align: center;">
                <tr>
                    <td scope="col">{{ $loop->iteration }}</td>
                    <td scope="col">{{ $item->id_order }}</td>
                    <td scope="col">{{ $item->no_meja }}</td>
                    <td scope="col" class="col-2">
                        <label for="" style="color: white; padding-bottom: 2px; padding-top: 2px;" class="btn btn-warning btn-sm">{{ $item->status }}</label>
                    </td>
                    <td scope="col">{{ $item->tanggal }}</td>
                    <td scope="col" class="col-2">
                        <form action="/restauran/orders/{{ $item->id_order }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="padding-bottom: 2px; padding-top: 2px;">Selesai</button>
                        </form>
                    </td>
                </tr>
            @endif
            @endforeach
                @if ($count == 0 || !$order->count())
                <tr>
                    <td colspan="6" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                </tr>
                @endif
            </tbody>
          </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4 mb-5" style="margin-left: 9rem">
    {{ $order->links() }}
</div> 
@endsection



