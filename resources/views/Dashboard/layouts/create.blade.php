@extends('Dashboard.dash')

@section('tittle2', 'Tambah Menu')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('content')
    <div class="col-lg-8 ">
        <form method="post" action="/restauran/menu" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
              <label for="" class="form-label">Nama Menu</label>
              <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" id="" name="nama_menu" required autofocus>
              @error('nama_menu')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Harga</label>
              <input type="text" class="form-control @error('harga') is-invalid @enderror" id="" name="harga" required>
              @error('harga')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Stok</label>
              <input type="text" name="stok" class="form-control @error('stok') is-invalid @enderror" id="" required>
              @error('stok')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-4">
              <label for="formFile" class="form-label"></label>
              <img class="img-preview img-fluid mb-3 col-sm-2">
              <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" onchange="previewImage()" required>
              @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <select name="jenis_menu" id="jenis_menu" class="form-select" aria-label="Default select example" required>
                <option value="" selected hidden>-- Kategori Menu --</option>
                <option name="" value="makanan">Makanan</option>
                <option name="" value="minuman">Minuman</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary"><span data-feather="plus-circle" style="margin-bottom: 2px"></span>   Tambah Menu</button>
            <a href="/restauran/menu" class="btn btn-danger"><span data-feather="arrow-left-circle" style="margin-bottom: 2px"></span>   Kembali</a>
          </form>
    </div>

    <script>
      function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
    </script>
@endsection
