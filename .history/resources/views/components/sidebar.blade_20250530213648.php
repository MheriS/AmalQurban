@auth
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">STISLA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">S</a>
        </div>
        <ul class="sidebar-menu">

            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="{{ Request::is('setting-aplikasi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('setting-aplikasi') }}"><i class="fas fa-cogs"></i><span>Setting Aplikasi</span></a>
            </li>

            <li class="{{ Request::is('data-wilayah') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('data-wilayah') }}"><i class="fas fa-th"></i><span>Data Wilayah</span></a>
            </li>

            {{-- Data User --}}
            <li class="nav-item dropdown {{ Request::is('data-user*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Data User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('data-user/admin') ? 'active' : '' }}"><a class="nav-link" href="{{ url('data-user/admin') }}">Admin</a></li>
                    <li class="{{ Request::is('data-user/panitia') ? 'active' : '' }}"><a class="nav-link" href="{{ url('data-user/panitia') }}">Panitia</a></li>
                </ul>
            </li>

            {{-- Kupon Pengkurban --}}
            <li class="nav-item dropdown {{ Request::is('kupon-pengkurban*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Kupon Pengkurban</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('kupon-pengkurban/semua') ? 'active' : '' }}"><a class="nav-link" href="{{ url('kupon-pengkurban/semua') }}">Semua</a></li>
                    <li class="{{ Request::is('kupon-pengkurban/belum') ? 'active' : '' }}"><a class="nav-link" href="{{ url('kupon-pengkurban/belum') }}">Belum Scan</a></li>
                    <li class="{{ Request::is('kupon-pengkurban/sudah') ? 'active' : '' }}"><a class="nav-link" href="{{ url('kupon-pengkurban/sudah') }}">Sudah Scan</a></li>
                </ul>
            </li>

            {{-- Kupon Umum --}}
            <li class="nav-item dropdown {{ Request::is('kupon-umum*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Kupon Umum</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a href="{{ route('kuponumum.index') }}" class="nav-link text-white {{ request()->is('kuponumum') ? 'active fw-bold' : '' }}">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kuponumum.belum') }}" class="nav-link text-white {{ request()->is('kuponumum/belum-scan') ? 'active fw-bold' : '' }}">Belum Scan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kuponumum.sudah') }}" class="nav-link text-white {{ request()->is('kuponumum/sudah-scan') ? 'active fw-bold' : '' }}">Sudah Scan</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('scan-kupon') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('scan-kupon') }}"><i class="fas fa-camera"></i><span>Scan Kupon</span></a>
            </li>

            <li class="{{ Request::is('riwayat-scan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('riwayat-scan') }}"><i class="fas fa-layer-group"></i><span>Riwayat Scan</span></a>
            </li>

            <li class="{{ Request::is('rekapitulasi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('rekapitulasi') }}"><i class="fas fa-file-alt"></i><span>Rekapitulasi</span></a>
            </li>

            <li class="{{ Request::is('profile/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/edit') }}"><i class="far fa-user"></i><span>Profile</span></a>
            </li>

        </ul>
    </aside>
</div>
@endauth