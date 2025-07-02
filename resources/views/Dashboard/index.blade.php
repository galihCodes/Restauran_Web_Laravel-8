@extends('Dashboard.dash')

@section('tittle2', 'Dashboard')
@if (Auth::check())
@section('nama')
    @auth
       {{ auth()->user()->full_name }}
    @endauth
@endsection
@endif
@section('content')

<script src="/admin/chart/dist/chart.min.js"></script>
<script src="/admin/chart/dist/chart.js"></script>
<link rel="stylesheet" href="/admin/adminlte.css">
    <div>
        <div class="row">
          @if (auth()->user()->level == 'kasir')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $order }}</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i><a href="/restauran/orders"><img src="/admin/icon/filea.png" alt="" class="col-lg-5" style="margin-left: 8.5rem; margin-bottom: 5rem"><a></i>
              </div>
              <a href="/restauran/orders" class="small-box-footer">More info <i data-feather='arrow-right-circle'></i></a>
            </div>
          </div>
              
          @else
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $user->count() }}</h3>

                <p style="margin-bottom: -5px">User <br>Registration</p>
              </div>
              <div class="icon">
                <i><a href="/restauran/users"><img src="/admin/icon/add-user.png" alt="" class="col-lg-tes" style="margin-left: 8.5rem; margin-bottom: 4.5rem"><a></i>
              </div>
              <a href="/restauran/users" class="small-box-footer">More info <i data-feather='arrow-right-circle'></i></a>
            </div>
          </div>
          @endif
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $menu }}<sup style="font-size: 20px"></sup></h3>
  
                  <p>Menu</p>
                </div>
                <div class="icon">
                  <i><a href="/restauran/menu"><img src="/admin/icon/food.png" alt="" class="col-lg-5" style="margin-left: 8rem; margin-bottom: 5rem"><a></i>
                </div>
                <a href="/restauran/menu" class="small-box-footer">More info <i data-feather='arrow-right-circle'></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $table }}</h3>
  
                  <p>Daftar Meja</p>
                </div>
                <div class="icon">
                  <i><a href="/restauran/table"><img src="/admin/icon/table.png" alt="" class="col-lg-5" style="margin-left: 8rem; margin-bottom: 4rem"><a></i>
                </div>
                <a href="/restauran/table" class="small-box-footer">More info <i data-feather='arrow-right-circle'></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $detail }}</h3>
  
                  <p>Terjual</p>
                </div>
                <div class="icon">
                  <i><a href="{{ auth()->user()->level == "admin" ? '/restauran/laporan' : '/restauran/pembayaran' }}"><img src="/admin/icon/salesa.png" alt="" class="col-lg-5" style="margin-left: 8rem; margin-bottom: 4rem"><a></i>
                </div>
                <a href="{{ auth()->user()->level == "admin" ? '/restauran/laporan' : '/restauran/pembayaran' }}" class="small-box-footer">More info <i data-feather='arrow-right-circle'></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
        </div>
        {{-- @if (auth()->user()->level == "admin")
        <div width="900" height="380">
          <canvas class="my-4 w-100" id="myChart"></canvas>
        </div>

    <script>
      var ctx= document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["07.00", "09.00", "11.00", "13.00", "15.00", "17.00", "19.00", "21.00", "23.00"],
          datasets: [{
            label: 'Today',
            data: [100, 19, 3, 13, 12, 11, 12, 14, 4],
            borderColor: 'rgb(75, 192, 192)'
          }]
        },
        option: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true
              }
            }]
          }
        }
      });
    </script>
    @endif --}}
@endsection