 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Halaman
        @if (auth()->user()->role == 'superadmin')
            Super Admin
        @elseif (auth()->user()->role == 'pegawai')
            Pegawai
        @elseif (auth()->user()->role == 'anggota')
            Anggota
        @endif
    </title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">

    {{-- custom css --}}
    <link href="{{ asset('assets/custom-css.css') }}" rel="stylesheet">

    @stack('plugin-css')

    <link rel="stylesheet" href="{{ asset('modules/izitoast/css/iziToast.min.css') }}">
    {{-- Plugin css --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/icon/dark-icon.png') }}" />

    @stack('custom-css')
</head>
{{-- <body style="-moz-transform: scale(0.8, 0.8); zoom: 0.8; zoom: 90%;"> --}}
<body>

    @if (auth()->user()->role == 'anggota')
    <nav class="navbar navbar-light text-dark navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom nav-mobile" style="border-top: 1px solid #cccccc; background-color: #fff;">
        <ul class="navbar-nav nav-justified w-100">
          <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                  <i class="fal fa-home"></i><br/>
                  <span>Beranda</span>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('katalog.index') }}" class="nav-link {{ Request::is('katalog*') ? 'active' : '' }}">
                <i class="fa-light fa-books"></i><br/>
                <span>Katalog</span>
            </a>
        </li>
          <li class="nav-item">
            <a href="{{ route('riwayat.index') }}" class="nav-link {{ Request::is('riwayat*') ? 'active' : '' }}">
                <i class="fa-light fa-clock-rotate-left"></i><br/>
                <span>Riwayat Pinjam</span>
            </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('profil.index') }}" class="nav-link {{ Request::is('profil*') ? 'active' : '' }}">
                <div class="point-nav-mobile"></div>
                  <i class="fal fa-user"></i><br/>
                  <span>Profil</span>
              </a>
          </li>
        '
        </ul>
    </nav>    
    @endif

    <div id="wrapper">
        {{-- Navbar --}}
        @include('layouts.navbar')
        {{-- Navbar --}}

        {{-- side-bar --}}
        @include('layouts.sidebar')
        {{-- side-bar --}}

        {{-- content --}}
        <div class="content-page">
            @yield('content')
        </div>
        {{-- content --}}

        @if (auth()->user()->role != 'anggota')
        {{-- footer --}}
        @include('layouts.footer')
        {{-- footer --}}
        @endif
    </div>

    <!-- jQuery  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/waves.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/pages/dashboard.init.js') }}"></script> --}}

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>


    @stack('plugin-js')
    <script src="{{ asset("modules/izitoast/js/iziToast.min.js") }}"></script>
    <script src="{{ asset("modules/jquery-loading/jquery.loading.min.js") }}"></script>
    @if (Request::is('laporan*'))
    @else
    <script>
        $("form").submit(function (){
            $('body').loading('toggle');
        })
    </script>
    @endif

    @if(Session::has('message'))
    <script>
        iziToast.success({
            title: "{{ Session::get('title') }}",
            message: "{{ Session::get('message') }}",
            position: 'topRight'
        });
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        iziToast.error({
            message: "{{ Session::get('error') }}",
            position: 'topRight'
        });
    </script>
    @endif

    @stack('custom-js')
</body>

</html>
