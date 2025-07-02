<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant</title>

    <!-- Bootstrap core CSS -->
    <link href="/admin/bootstrap5/css/bootstrap.css" rel="stylesheet">

    {{-- Icon Title --}}
    <link rel="icon" href="/admin/icon/restaurant.png">

    <!-- Custom styles for this template -->
    <link href="/admin/dashboard.css" rel="stylesheet">
    <link href="/admin/dashboard.rtl.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="height: 2.9rem">
  @if (auth()->user()->level == "admin")
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" style="font-size: 14px" href="/restauran/users/{{ auth()->user()->id }}/edit">Welcome back, @yield('nama')</a>
  @elseif (auth()->user()->level == "kasir")
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" style="font-size: 14px" href="/myprofil/{{ auth()->user()->id }}">Welcome back, @yield('nama')</a>
  @endif
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  @yield('search')
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" onclick="return confirm('Logout?')" href="/logout">Logout</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('restauran') ? 'active' : '' }}" aria-current="page" href="/restauran">
              <span data-feather="home"></span>
              Restauran
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('restauran/menu') ? 'active' : '' }}" href="/restauran/menu">
              <span data-feather="coffee"></span>
              Menu
            </a>
          </li>
          @if (auth()->user()->level == "admin")
          <li class="nav-item">
            <a class="nav-link {{ Request::is('restauran/users') ? 'active' : '' }}" href="/restauran/users">
              <span data-feather="users"></span>
              Pengguna
            </a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link {{ Request::is('restauran/orders') ? 'active' : '' }}" href="/restauran/orders">
              <span data-feather="file-text"></span>
              Pesanan
            </a>
          </li>
          @endif
          
          @if (auth()->user()->level == "kasir")
          <li class="nav-item">
            <a class="nav-link {{ Request::is('restauran/pembayaran') ? 'active' : '' }}" href="/restauran/pembayaran">
              <span data-feather="dollar-sign"></span>
              Pembayaran
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link {{ Request::is('restauran/table') ? 'active' : '' }}" href="/restauran/table">
              <span data-feather="archive"></span>
              Daftar Meja
            </a>
          </li>
          @if (auth()->user()->level == "admin")
            <li class="nav-item">
              <a class="nav-link {{ Request::is('restauran/laporan') ? 'active' : '' }}" href="/restauran/laporan">
                <span data-feather="bar-chart-2"></span>
                Laporan
              </a>
            </li>
          @endif
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@yield('tittle2')</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          @yield('cart')
          @yield('create')
          @yield('this')
        </div>
      </div>
      @yield('content')
    </main>
  </div>
</div>


      <script src="/admin/bootstrap5/js/bootstrap.bundle.min.js"></script>
      <script src="/admin/feather.min.js"></script>
      <script src="/admin/dashboard.js"></script>
  </body>
</html>
