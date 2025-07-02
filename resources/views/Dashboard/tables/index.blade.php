@extends('Dashboard.dash')

@section('tittle2', 'Daftar Meja')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif

@section('this')
  <form action="/restauran/table">
    <div class="input-group">
      <input type="search" class="form-control" aria-describedby="search-addon" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
      <button type="submit" class="btn btn-primary ">
        Search
      </button>
    </div>
  </form>
@endsection

@if (auth()->user()->level == 'admin')
  @section('create')
      <div class="btn-group me-3 mt-1">
      <a href="/restauran/table/create"><button type="button" class="btn btn-sm btn-outline-secondary">Tambah Meja  <span data-feather="plus-circle"></span></button></a>
    </div>
  @endsection 
@endif

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (auth()->user()->level == 'kasir')
<div class="container">
  <div class="card col-4 me-5" style="float: left">
    <div class="card-header" style="font-size: 16px">
        <span data-feather="clipboard" style="margin-bottom: 1px"></span>   <strong>Data Meja</strong>
    </div>
    <div class="card-body">
    <table class="table table-bordered table-hover col-8 " border="1" style="border-color: rgb(226, 224, 224)">
        <thead style="text-align: center;">
          <tr class="table-light table-secondary">
              <th scope="col" style="vertical-align: middle; width: 60px;">Nomor Meja</th>
              <th scope="col" style="vertical-align: middle; width: 60px; border-right: 20px;">Status</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
          @foreach ($data as $item)
                <tr>
                    <td scope="col">{{ $item->Nomor_Meja }}</td>
                    <td scope="col" style="margin: 6px auto; color: black;" class="{{ $item->status == 'Kosong' ? 'btn btn-info btn-sm' : 'btn btn-warning btn-sm' }}">{{ $item->status }}</td>
                </tr>
                @endforeach
                @if (!$data->count())
                  <tr>
                    <td colspan="2" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                  </tr>
                @endif
          </tbody>
      </div>
      </table>
  </div>
</div>
<div class="container">
  <div class="card col-7" style="height: 23.75rem">
    <div class="card-header" style="font-size: 16px">
        <span data-feather="info" style="margin-bottom: 1px"></span>   <strong>Data Info</strong>
    </div>
    <div class="card-body">
    <table class="table table-bordered table-hover col-8" border="1">
        <thead style="text-align: center;">
          <tr class="table-light table-secondary">
              <th scope="col" style="vertical-align: middle; width: 60px;">Nomor Meja</th>
              <th scope="col" style="vertical-align: middle; width: 60px;">Keterangan</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
          @foreach ($data as $item)
                <tr>
                    <td scope="col">{{ $item->Nomor_Meja }}</td>
                    <td scope="col">{{ $item->Keterangan }}</td>
                </tr>
                @endforeach
                @if (!$data->count())
                  <tr>
                    <td colspan="2" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                  </tr>
                @endif
          </tbody>
      </div>
      </table>
  </div>
</div>
  @if (auth()->user()->level == 'kasir')
    <div class="d-flex justify-content-center mb-4" style="margin-top: 4rem;margin-right: 15rem;">
      {{ $data->links() }}
    </div>  
  @endif

@else
<div class="container">
  <div class="card" style="height: 100%">
    <div class="card-header" style="font-size: 16px">
        <span data-feather="clipboard" style="margin-bottom: 1px"></span>   <strong>Data Meja</strong>
    </div>
    <div class="card-body">
    <table class="table table-bordered table-hover " border="1" style="border-color: rgb(226, 224, 224)">
        <thead style="text-align: center;">
          <tr class="table-light table-secondary">
              <th scope="col" style="vertical-align: middle; width: 60px;">Nomor Meja</th>
              <th scope="col" style="vertical-align: middle; width: 60px;">Keterangan</th>
              <th scope="col" style="vertical-align: middle; width: 60px;">Aksi</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
          @foreach ($data as $item)
                <tr>
                    <td scope="col">{{ $item->Nomor_Meja }}</td>
                    <td scope="col">{{ $item->Keterangan }}</td>
                    <td scope="col">
                        <a href="/restauran/table/{{ $item->id_meja }}/edit" class="btn btn-info"><span data-feather="edit" style="margin-bottom: 0.1rem"></span></a>
                        <form action="/restauran/table/{{ $item->id_meja }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" style="margin-bottom: 0.1rem" ></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if (!$data->count())
                  <tr>
                    <td colspan="3" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                  </tr>
                @endif
          </tbody>
      </div>
      </table>
  </div>
</div>

@if (auth()->user()->level == 'admin')
  <div class="d-flex justify-content-center mt-4 mb-5">
    {{ $data->links() }}
  </div>  
@endif

@endif
@endsection