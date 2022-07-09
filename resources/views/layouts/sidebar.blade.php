<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{ route('home') }}" class="waves-effect {{ Request::is('/') ? 'mm-active' : '' }}">
                        <i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
                    </a>
                </li>

                @if (auth()->user()->role != 'anggota')
                <li class="menu-title">Master Data</li>

                <li>
                    <a href="{{ route('buku.index') }}" class="waves-effect {{ Request::is('buku*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-books"></i> <span> Buku</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->role == 'superadmin')
                <li>
                    <a href="{{ route('pegawai.index') }}" class="waves-effect {{ Request::is('pegawai*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-user-tie"></i> <span> Pegawai Perpustakaan</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->role != 'anggota')
                <li>
                    <a href="{{ route('anggota.index') }}" class="waves-effect {{ Request::is('anggota*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-users"></i> <span> Anggota</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->role != 'anggota')
                <li class="menu-title">Transaksi</li>

                <li>
                    <a href="{{ route('transaction.index') }}" class="waves-effect {{ Request::is('transaction*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-ballot-check"></i> <span> Peminjaman</span>
                    </a>
                </li>

                <li class="menu-title">Laporan</li>

                <li>
                    <a href="{{ route('laporan.index') }}" class="waves-effect {{ Request::is('laporan*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-file-chart-column"></i> <span> Laporan</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role == 'anggota')
                <li>
                    <a href="{{ route('katalog.index') }}" class="waves-effect {{ Request::is('katalog*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-books"></i> <span> Katalog</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('riwayat.index') }}" class="waves-effect {{ Request::is('riwayat*') ? 'mm-active' : '' }}">
                        <i class="fa-light fa-clock-rotate-left"></i> <span> Riwayat Pinjam</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profil.index') }}" class="waves-effect {{ Request::is('profil*') ? 'mm-active' : '' }}">
                        <i class="fal fa-user"></i> <span> Profil</span>
                    </a>
                </li>
                @endif

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
