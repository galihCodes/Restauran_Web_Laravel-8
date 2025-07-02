@extends('Dashboard.dash')

@section('tittle2', 'Edit Data')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('content')
    <div class="col-lg-8 ">
        @foreach ($user as $item)
        <form method="post" class="mb-5" action="/restauran/users/{{ $item->id }}">
          @csrf
          @method('put')
            <div class="mb-3">
              <label for="" class="form-label">Nama User</label>
              <input type="text" class="form-control @error('name') is_invalid @enderror" id="" name="full_name" value="{{ old('name', $item->full_name) }}" required>
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is_invalid @enderror" id="" name="username" value="{{ old('username', $item->username) }}" required>
              @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is_invalid @enderror" id="" value="{{ old('password', $item->password) }}" required>
              @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
                </div>
            <div class="mb-3">
              <label for="" class="form-label">Telepon</label>
              <input type="text" name="telepon" class="form-control @error('telepon') is_invalid @enderror" id="" value="{{ old('telepon', $item->telepon) }}" required>
              @error('telepon')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
                </div>
            <div class="mb-3">
              <select value="" name="level" id="level" class="form-select" aria-label="Default select example" required>
                <option  selected hidden>-- Kategori user --</option>
                <option name="" value="admin" {{ $item->level == "admin" ? 'selected' : ''}} {{ $cek == "admin" ? '' : 'hidden' }}>Admin</option>
                <option name="" value="kasir" {{ $item->level == "kasir" ? 'selected' : ''}}>Kasir</option>
              </select>
            </div>@endforeach
            <button type="submit" class="btn btn-primary"><span data-feather="edit" style="margin-bottom: 2px"></span>   Update user</button>
            <a href="/restauran/users" class="btn btn-danger"><span data-feather="arrow-left-circle" style="margin-bottom: 2px"></span>   Kembali</a>
          </form>
    </div>
@endsection