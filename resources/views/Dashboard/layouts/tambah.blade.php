@extends('Dashboard.dash')

@section('tittle2')
    <div align="left">
        <h6 class="mt-2">
            <a href="/restauran" style="color: grey; text-decoration: none;">Home</a><span style="color: grey"> / </span><a href="/restauran/menu" style="color: grey; text-decoration: none;">Menu</a><span style="color: grey"> / </span><a href="#" style="text-decoration: none">Tambah Stok</a>
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
@section('content')
<div class="card" style="height: max-content; width: 80%;">
    <div class="card-header" style="font-size: 16px">
        <strong style="display: flex; justify-content: center; font-size: 19px;">Edit Stok</strong>
    </div>
    <div class="card-body d-flex">
        @foreach ($data as $item)
            <img src="/storage/{{ $item->image }}" alt="" style="width: 20rem; margin-right: 3rem; height: 15rem;">
            <form action="/restauran/menu/{{ $item->id_menu }}/tambahstok" method="POST" class="col-4 " style="">
                @csrf
                @method('put')
                <div class="mb-3">
                 <fieldset disabled>
                    <label for="" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" name="nama" value="{{ $item->nama_menu }}">
                  </div>
                </fieldset>
                <div class="mb-3">
                    <label for="" class="form-label">Tambah Stok</label>
                    <input type="number" class="form-control" id="" min="-{{ $item->stok }}" name="stok" required>
                </div>
                <button type="submit" style="width: 100%; margin-bottom: 5px" class="btn btn-success" onclick="return confirm('Tambah Stok?')"><span data-feather="send"></span> Kirim</button>
                <a href="/restauran/menu" style="width: 100%;" class="btn btn-danger"><span data-feather="arrow-left-circle"></span> Back</a>
            </form>
        @endforeach
    </div>
</div>
@endsection
