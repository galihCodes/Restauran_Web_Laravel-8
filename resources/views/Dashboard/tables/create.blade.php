@extends('Dashboard.dash')

@section('tittle2', 'Tambah Meja')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('content')
    <div class="col-lg-8 ">
        <form method="post" action="/restauran/table">
          @csrf
            <div class="mb-3">
              <label for="" class="form-label">Nomor Meja</label>
              <input type="text" class="form-control @error('Nomor_Meja') is-invalid @enderror" id="" name="Nomor_Meja" required autofocus>
              @error('Nomor_Meja')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Keterangan</label>
              <textarea type="form-control" class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan" name="Keterangan" required></textarea>
              @error('Keterangan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary"><span data-feather="plus-circle" style="margin-bottom: 2px"></span>   Tambah</button>
            <a href="/restauran/table" class="btn btn-danger"><span data-feather="arrow-left-circle" style="margin-bottom: 2px"></span>   Kembali</a>
          </form>
    </div>
@endsection
