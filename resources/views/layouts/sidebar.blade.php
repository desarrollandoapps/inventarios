<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{asset('img/svg/logo_texto.svg')}} " alt="Logo" class="logo_side">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-pallet"></i> --}}
        </div>
        {{-- <div class="sidebar-brand-text mx-3">Estiba</div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('home') }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>{{ __('Inicio') }}</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item  -->
    <li class="nav-item {{ Nav::isRoute('proveedor.index') }}">
        <a class="nav-link" href="{{ route('proveedor.index') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span>{{ __('Providers') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('producto.index') }}">
        <a class="nav-link" href="{{ route('producto.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>{{ __('Products') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('venta.index') }}">
        <a class="nav-link" href="{{ route('venta.index') }}">
            <i class="fas fa-fw fa-calculator"></i>
            <span>{{ __('Sales') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Analysis') }}
    </div>

    <!-- Nav Item  -->
    <li class="nav-item {{ Nav::isRoute('analisis.filtro') }} {{ Nav::isRoute('analisis.filtrar') }} {{ Nav::isRoute('analisis.filtrado') }}">
        <a class="nav-link" href="{{ route('analisis.filtro') }}">
            <i class="fas fa-fw fa-funnel-dollar"></i>
            <span>{{ __('Filter') }}</span>
        </a>
    </li>
    <!-- Nav Item  -->
    <li class="nav-item {{ Nav::isRoute('analisis.verAbc') }} {{ Nav::isRoute('analisis.clasificacionABC') }} {{ Nav::isRoute('abc.grafico') }}">
        <a class="nav-link" href="{{ route('analisis.verAbc') }}">
            <i class="fas fa-fw fa-sort-amount-down"></i>
            <span>{{ __('ABC Classification') }}</span>
        </a>
    </li>
    <!-- Nav Item  -->
    <li class="nav-item {{ Nav::isRoute('analisis.verXyz') }} {{ Nav::isRoute('analisis.clasificacionXYZ') }}">
        <a class="nav-link" href="{{ route('analisis.verXyz') }}">
            <i class="fas fa-fw fa-sort-alpha-down"></i>
            <span>{{ __('XYZ Classification') }}</span>
        </a>
    </li>
    <!-- Nav Item  -->
    <li class="nav-item {{ Nav::isRoute('analisis.verAbcXyz') }} {{ Nav::isRoute('analisis.clasificacionABCXYZ') }}">
        <a class="nav-link" href="{{ route('analisis.verAbcXyz') }}">
            <i class="fas fa-fw fa-sort-numeric-down"></i>
            <span>{{ __('ABC - XYZ Classification') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Users') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>

    <!-- Nav Item - About -->
    <li class="nav-item {{ Nav::isRoute('about') }}">
        <a class="nav-link" href="{{ route('about') }}">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>{{ __('About') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->