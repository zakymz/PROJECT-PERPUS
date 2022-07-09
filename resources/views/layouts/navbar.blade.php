<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="logo">
            <span class="logo-light">
                <img src="{{ asset('assets/icon/light-logo.png') }}" style="width: 180px" alt="">
                </span>
            <span class="logo-sm">
                <img src="{{ asset('assets/icon/light-icon.png') }}" style="width: 30px" alt="">
            </span>
        </a>
    </div>

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">

            <!-- language-->
            {{-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-theme-light-dark noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                    <a class="dropdown-item" href="#!"><span> Tema Terang </span></a>
                    <a class="dropdown-item" href="#!"><span> Tema Gelap </span></a>
                </div>
            </li> --}}

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                </a>
            </li>

            <!-- notification -->
            @if (auth()->user()->role != 'anggota')
            <li class="dropdown notification-list list-inline-item">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pill badge-danger noti-icon-badge">{{ $peminjaman_jatuh_tempo->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                    <!-- item-->
                    <h6 class="dropdown-item-text">
                        Notifikasi Kamu
                    </h6>
                    <div class="slimscroll notification-item-list">
                        @forelse ($peminjaman_jatuh_tempo as $item)
                            <a href="{{ route('transaction.show', $item->id) }}" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning"><i class="fas fa-info"></i></div>
                                <p class="notify-details"><b>Peminjaman Buku {{ $item->relatedAnggota->relatedUser->name }}<font style="font-size: 10px;"></font></b>
                                    <span class="text-muted">Sebentar lagi buku harus di kembalikan tanggal {{ TanggalID('j M Y', $item->tgl_berakhir) }}</span>
                                </p>
                            </a>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </li>
            @else
            <li class="dropdown notification-list list-inline-item">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pill badge-danger noti-icon-badge">{{ $peminjaman_anggota_jatuh_tempo->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                    <!-- item-->
                    <h6 class="dropdown-item-text">
                        Notifikasi Kamu
                    </h6>
                    <div class="slimscroll notification-item-list">
                        @forelse ($peminjaman_anggota_jatuh_tempo as $item)
                            <a href="{{ route('riwayat.show', $item->id) }}" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning"><i class="fas fa-info"></i></div>
                                <p class="notify-details"><b>Peminjaman Buku Akan Segera Berkahir<font style="font-size: 10px;"></font></b>
                                    <span class="text-muted">Sebentar lagi buku harus di kembalikan tanggal {{ TanggalID('j M Y', $item->tgl_berakhir) }}</span>
                                </p>
                            </a>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </li>
            @endif

            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar_url }}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        {{-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></iW> Profile</a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item text-danger">
                            <i class="mdi mdi-logout-variant text-danger"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            Logout
                        </a>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="fas fa-bars"></i>
                </button>
            </li>
            <li class="d-none d-md-inline-block">

            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
