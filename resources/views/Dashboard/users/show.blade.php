@extends('Dashboard.dash')

@section('tittle2', 'My Profil')
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
        <form action="">
          <fieldset disabled>
            <div class="mb-3">
              <label for="" class="form-label">Nama User</label>
              <input type="text" class="form-control" id="" name="name" value="{{ old('name', $item->full_name) }}" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Username</label>
              <input type="text" class="form-control" id="" name="username" value="{{ old('username', $item->username) }}" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="" value="{{ old('password', $item->password) }}" required>
                </div>
            <div class="mb-3">
              <label for="" class="form-label">Telepon</label>
              <input type="text" name="telepon" class="form-control" id="" value="{{ old('telepon', $item->telepon) }}" required>
                </div>
            <div class="mb-3">
              <select value="" name="level" id="level" class="form-select" aria-label="Default select example" required>
                <option name="" value="kasir" {{ $item->level == "kasir" ? 'selected' : ''}}>Kasir</option>
              </select>
            </div>
            @endforeach
          </fieldset>
        <a href="/restauran" class="btn btn-danger"><span data-feather="arrow-left-circle" style="margin-bottom: 2px"></span>   Kembali</a> 
        </form>
    </div>
@endsection