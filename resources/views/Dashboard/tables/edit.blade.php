@extends('Dashboard.dash')

@section('tittle2', 'Edit Meja')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('content')
    <div class="col-lg-8 ">
        @foreach ($data as $item)
        <form action="/restauran/table/{{ $item->id_meja }}" method="POST">
        @method('put')
          @csrf
          <div class="mb-3">
            <label for="" class="form-label">Nomor Meja</label>
            <input type="text" class="form-control @error('Nomor_Meja') is-invalid @enderror" value="{{ old('Nomor_Meja', $item->Nomor_Meja) }}" id="" name="Nomor_Meja" required autofocus>
            @error('Nomor_Meja')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Keterangan</label>
            <textarea type="form-control" class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan" name="Keterangan" required>{{ old('keterangan', $item->Keterangan) }}</textarea>
            @error('Keterangan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary"><span data-feather="edit" style="margin-bottom: 2px"></span>   Update</button>
          <a href="/restauran/table" class="btn btn-danger"><span data-feather="arrow-left-circle" style="margin-bottom: 2px"></span>   Kembali</a>
        </form>
        @endforeach
    </div>
@endsection
