@extends('Dashboard.dash')

@section('tittle2', 'Menu Restauran')

@if (Auth::check())
  @section('nama')
    @auth
      {{ auth()->user()->full_name }}
    @endauth
  @endsection
@endif

@if (auth()->user()->level == "kasir")
@section('cart')
<div class ="btn-group me-3 mt-1">
  <a href={{ $cek == 0 ? '' : '/restauran/orders/proses'}}><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="file"></span>  Orders [{{ $cek }}]</button></a>
</div>
@endsection
@endif

@section('this')
  <form action="/restauran/menu">
    <div class="input-group">
      <input type="search" class="form-control" aria-describedby="search-addon" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
      <button type="submit" class="btn btn-primary ">
        Search
      </button>
    </div>
  </form>
@endsection

@if (auth()->user()->level == "admin")
@section('cart')
<div class="btn-group me-3 mb-1 mt-1">
  <button type="button"  data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-sm btn-outline-secondary">Tambah Stok  <span data-feather="download" style="margin-bottom: 2px"></span></button>
</div>
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Stok</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/restauran/tambahstok" method="POST">
            @csrf
          <div class="modal-body">
                <div class="mb-3">
                  <label for="" class="form-label">Nama Menu</label>
                  <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Tambah Stok</label>
                  <input type="number" class="form-control" id="" min="1" name="stok" required>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" onclick="return confirm('Tambah Stok?')"><span data-feather="send"></span> Kirim</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection


@section('create')
<div class="btn-group me-3 mt-1">
<a href="/restauran/menu/create"><button type="button" class="btn btn-sm btn-outline-secondary">Tambah Menu  <span data-feather="plus-circle"></span></button></a>
</div>
@endsection
@endif
 
@section('content')

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
@endif


  @if ($makanan || request('search') == "" )
    @if (count($makanan)>0)
    @if (request('search') != $makanan)
      <h3 class="container">{{ request('search') ? 'Hasil' : 'Makanan'}}</h3>
        <div class="container d-flex" style="overflow-x: scroll; min-width: 100px;">
          @foreach ($makanan as $item)
            <div class="card float-sm-start me-3 mb-4 col-8" style="width: 18rem">
              <img src="/storage/{{ $item->image }}" class="img-fluid col-sm-20" style="height: 10rem" alt="">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->nama_menu }}</h5>
                    <p class="card-text" style="{{ auth()->user()->level == 'admin' ? 'float: left; margin-right: -2px' : '' }}">Rp {{ number_format($item->harga, 0, ',', '.') }}
                      <span class="ms-3">Stok : {{ $item->stok }}</span>
                      @if (auth()->user()->level == "admin")
                      <form action="/restauran/menu/{{ $item->id_menu }}/tambahstok" method="POST">
                        @csrf
                        <button type="submit" style="border: none; background: none; color: #6c757d;"><span style="margin-bottom: 1px;" data-feather="plus-circle"></span></button>
                      </form>
                      @endif
                    </p>
                 @if (auth()->user()->level == "kasir")
                    @if ($item->stok >0 )
                    @if ($exist->where('id_menu',  $item->id_menu )->count())
                    <a class="btn btn-primary" style="margin-right: 0.4rem; margin-bottom: -1.5rem;"><span data-feather="check-square" style="margin-bottom: 0.1rem; margin-right: 0.4rem;"></span>In Order</a>
                @else
                  <form action="/cart/{{ $item->id_menu }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" style="margin-right: 0.4rem"><span data-feather="plus" style="margin-bottom: 0.1rem; margin-right: 0.4rem;"></span>Add to Orders</button>
                    <input type="number" style="margin-top: 10px" min="1" value="1" max="{{ $item->stok }}" class="col-2" name="jumlah">
                  </form>
                @endif
                    @else
                    <a style="cursor: not-allowed; margin-bottom: -1.5rem;" class="btn btn-secondary"><span data-feather="slash" style="margin-bottom: 0.1rem; margin-right: 0.2rem;"></span>Habis</a>
                    @endif
                  @else
                    <a href="/restauran/menu/{{ $item->id_menu }}/edit" class="btn btn-info"><span data-feather="edit" style="margin-bottom: 0.1rem"></span> Edit</a>
                    <form action="/restauran/menu/{{ $item->id_menu }}" method="POST" class="d-inline">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" style="margin-bottom: 0.1rem" class="me-1"></span>Hapus</button>
                    </form>
                  @endif
                </div>
            </div>
          @endforeach
        </div>  
    @endif
    @endif
    
    @if (count($minuman)>0)
    @if ($makanan != $minuman)
      <h3 class="container {{ count($makanan)== 0 ? '' : 'mt-5' }}">Minuman</h3>
      <div class="container d-flex mb-5" style="overflow-x: scroll; min-width: 100px;">
        @foreach ($minuman as $item)
          <div class="card float-sm-start me-3 mb-4 col-8" style="width: 18rem">
            <img src="/storage/{{ $item->image }}" class="img-fluid col-sm-20" style="height: 10rem" alt="">
            <div class="card-body">
              <h5 class="card-title">{{ $item->nama_menu }}</h5>
              <p class="card-text" style="float: left; margin-right: -2px">Rp {{ number_format($item->harga, 0, ',', '.') }}
                <span class="ms-3">Stok : {{ $item->stok }}</span>
                @if (auth()->user()->level == "admin")
                <form action="/restauran/menu/{{ $item->id_menu }}/tambahstok" method="POST">
                  @csrf
                  <button type="submit" style="border: none; background: none; color: #6c757d;"><span style="margin-bottom: 1px;" data-feather="plus-circle"></span></button>
                </form>
                @endif
              </p>
              @if (auth()->user()->level == "kasir")
                @if ($item->stok >0 )
                @if ($exist->where('id_menu',  $item->id_menu )->count())
                <a class="btn btn-primary" style="margin-right: 9rem; margin-top: 0.2rem"><span data-feather="check-square" style="margin-bottom: 0.1rem; margin-right: 0.4rem;"></span>In Order</a>
                @else
                  <form action="/cart/{{ $item->id_menu }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" style="margin-right: 0.4rem"><span data-feather="plus" style="margin-bottom: 0.1rem; margin-right: 0.4rem;"></span>Add to Orders</button>
                        <input type="number" style="margin-top: 10px" min="1" value="1" max="{{ $item->stok }}" class="col-2" name="jumlah">
                  </form>
                @endif
                @else
                <a style="cursor: not-allowed; margin-right: 9rem; margin-top: 0.2rem" class="btn btn-secondary"><span data-feather="slash" style="margin-bottom: 0.1rem; margin-right: 0.2rem;"></span>Habis</a>
                @endif
              @else
                <a href="/restauran/menu/{{ $item->id_menu }}/edit" class="btn btn-info"><span data-feather="edit" style="margin-bottom: 0.1rem"></span> Edit</a>
                <form action="/restauran/menu/{{ $item->id_menu }}" method="POST" class="d-inline">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" style="margin-bottom: 0.1rem" class="me-1"></span>Hapus</button>
                </form>
              @endif
            </div>
          </div>
        @endforeach  
      </div>  
      @endif
      @endif
    @endif

    @if (count($makanan) == 0 && count($minuman) == 0)
    <h5 align="center" style=" margin-top: 25px; font-size: 20px; color: gray; font-style: italic;">Not found</h5>
    @endif
@endsection