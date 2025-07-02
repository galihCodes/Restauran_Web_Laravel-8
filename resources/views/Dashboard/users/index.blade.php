@extends('Dashboard.dash')

@section('tittle2', 'Data User')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif

@section('this')
  <form action="/restauran/users">
    <div class="input-group">
      <input type="search" class="form-control" aria-describedby="search-addon" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
      <button type="submit" class="btn btn-primary ">
        Search
      </button>
    </div>
  </form>
@endsection

@if (auth()->user()->level == "admin")
@section('create')
    <div class="btn-group me-3 mt-1">
    <a href="/register"><button type="button" class="btn btn-sm btn-outline-secondary">Tambah Data  <span data-feather="plus-circle"></span></button></a>
  </div>
@endsection
@endif
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="card" style="height: 100%">
      <div class="card-header" style="font-size: 16px">
          <span data-feather="user" style="margin-bottom: 2px"></span>   <strong>Data User</strong>
      </div>
      <div class="card-body">
      <table class="table table-bordered table-hover " border="1" style="border-color: rgb(226, 224, 224)">
          <thead style="text-align: center;">
            <tr class="table-light table-secondary">
                <th scope="col" style="vertical-align: middle; width: 60px;">Id User</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Nama</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Nomor Telepon</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Email</th>
                <th scope="col" style="vertical-align: middle; width: 60px;">Aksi</th>
            </tr>
          </thead>
          <tbody style="text-align: center;">
            @foreach ($user as $item)
                  <tr>
                      <td scope="col">{{ $item->id }}</td>
                      <td scope="col">{{ $item->full_name }}</td>
                      <td scope="col">{{ $item->telepon }}</td>
                      <td scope="col">{{ $item->email }}</td>
                                <td scope="col">
                                    <a href="/restauran/users/{{ $item->id }}/edit" class="btn btn-info"><span data-feather="edit" style="margin-bottom: 0.1rem"></span></a>
                                    <form action="/restauran/users/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" style="margin-bottom: 0.1rem" ></span></button>
                                    </form>
                                </td>
                  </tr>
                  @endforeach
                  @if (!$user->count())
                    <tr>
                      <td colspan="5" align="center" style="color: gray">Tidak ada Data di Tabel</td>
                    </tr>
                  @endif
            </tbody>
        </div>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $user->links() }}
</div>

@endsection

{{-- Pagination --}}
{{-- Illuminate\Pagination\Paginator --}}
{{-- App\Provider\AppServiceProvider->boot() --}}
{{-- Paginator::useBootstrap() --}}
{{-- withQueryString --}}