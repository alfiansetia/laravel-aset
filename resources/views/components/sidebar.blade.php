<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">{{ env('APP_NAME_INITIAL') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ $title == 'Dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="{{ $title == 'Data Aset' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('asets.index') }}"><i class="fas fa-cubes"></i><span>Aset</span></a>
            </li>
            <li class="menu-header">Master</li>
            <li
                class="nav-item dropdown {{ $title == 'Data User' || $title == 'Data Kategori' || $title == 'Data Jenis' || $title == 'Data Lokasi' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title == 'Data User' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">User</a>
                    </li>
                    <li class="{{ $title == 'Data Kategori' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="{{ $title == 'Data Jenis' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jenis.index') }}">Jenis</a>
                    </li>
                    <li class="{{ $title == 'Data Lokasi' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('locations.index') }}">Lokasi</a>
                    </li>
                </ul>
            </li>

        </ul>

    </aside>
</div>
