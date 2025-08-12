<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('root.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('admin/assets/img/favicon-admin.png') }}"
                    style="width: 100%;height: 100%;object-fit: contain;" alt="logo">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        @if (Auth::user()->role->akses == 'admin' || Auth::user()->role->akses == 'mentah')
            <!-- Barang Mentah-->
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="Barang Mentah">Barang Mentah</span>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-mentah.index') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-mentah.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-package"></i>
                    <div data-i18n="Barang">Barang</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-mentah.stok*') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-mentah.stok.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-package"></i>
                    <div data-i18n="Stok">Stok</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-mentah.masuk*') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-mentah.masuk.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-arrow-bar-to-right"></i>
                    <div data-i18n="Masuk">Masuk</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-mentah.keluar*') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-mentah.keluar.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-arrow-bar-to-left"></i>
                    <div data-i18n="Keluar">Keluar</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->role->akses == 'admin' || Auth::user()->role->akses == 'jadi')
            <!-- Barang Jadi-->
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="Barang Jadi">Barang Jadi</span>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-jadi.index') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-jadi.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-package"></i>
                    <div data-i18n="Barang">Barang</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-jadi.stok*') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-jadi.stok.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-package"></i>
                    <div data-i18n="Stok">Stok</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-jadi.masuk*') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-jadi.masuk.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-arrow-bar-to-right"></i>
                    <div data-i18n="Masuk">Masuk</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.barang-jadi.keluar*') ? 'active' : '' }}">
                <a href="{{ route('admin.barang-jadi.keluar.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-arrow-bar-to-left"></i>
                    <div data-i18n="Keluar">Keluar</div>
                </a>
            </li>
        @endif


        <!-- ADMINISTRATOR-->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Setting">Setting</span>
        </li>

        @if (Auth::user()->role->akses == 'admin')
            <!-- Users -->
            <li class="menu-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                <a href="{{ route('admin.user.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="Users">Users</div>
                </a>
            </li>
            <!-- Role -->
            <li class="menu-item {{ request()->routeIs('admin.role*') ? 'active' : '' }}">
                <a href="{{ route('admin.role.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-key"></i>
                    <div data-i18n="Role">Role</div>
                </a>
            </li>
        @endif

        <!-- Profile -->
        <li class="menu-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
            <a href="{{ route('admin.profile.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Profile">Profile</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form-sidebar').submit();"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-logout"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</aside>
