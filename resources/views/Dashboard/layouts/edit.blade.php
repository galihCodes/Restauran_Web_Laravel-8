@extends('Dashboard.dash')

@section('tittle2', 'Edit Menu')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('content')
    <div class="col-lg-8 ">
        @foreach ($tes as $item)
        <form method="post" class="mb-5" action="/restauran/menu/{{ $item->id_menu }}" enctype="multipart/form-data">
          @csrf
          @method('put')
            <div class="mb-3">
              <label for="" class="form-label">Nama Menu</label>
              <input type="text" class="form-control @error('nama_menu') is_invalid @enderror" id="" name="nama_menu" value="{{ old('nama_menu', $item->nama_menu) }}" required>
              @error('nama_menu')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Harga</label>
              <input type="text" class="form-control @error('harga') is_invalid @enderror" id="" name="harga" value="{{ old('harga', $item->harga) }}" required>
              @error('harga')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Stok</label>
              <input type="text" name="stok" class="form-control @error('stok') is_invalid @enderror" id="" value="{{ old('stok', $item->stok) }}" required>
              @error('stok')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-4">
              <label for="formFile" class="form-label"></label>
              @if ($item->image)
                <img src="{{ asset('storage/'. $item->image) }}" class="img-preview img-fluid mb-3 col-sm-4">
              @else
                <img class="img-preview img-fluid mb-3 col-sm-2">
              @endif
              <input type="file"  id="image" name="image" class="form-control @error('image') is_invalid @enderror" onchange="previewImage()" required>
              @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <select value="" name="jenis_menu" id="jenis_menu" class="form-select" required>
                <option  selected hidden>-- Kategori Menu --</option>
                <option name="" value="makanan" {{ $item->jenis_menu == "makanan" ? 'selected' : ''}}>Makanan</option>
                <option name="" value="minuman" {{ $item->jenis_menu == "minuman" ? 'selected' : ''}}>Minuman</option>
                <option name="" value="dessert" {{ $item->jenis_menu == "dessert" ? 'selected' : '' }}>Dessert</option>
              </select>
            </div>@endforeach
            <button type="submit" class="btn btn-primary"><span data-feather="edit" style="margin-bottom: 2px"></span>   Update Menu</button>
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