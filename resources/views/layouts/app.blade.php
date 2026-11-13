<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield ('titulo', 'AGROVALLE HONDURAS')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{asset ('spark/assets/images/favicon.ico') }}">

  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="{{asset ('spark/assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset  ('spark/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{asset ('spark/assets/libs/apexcharts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{asset ('spark/assets/libs/flatpickr/flatpickr.min.css') }}">

  <!-- Main Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="{{asset ('spark/assets/css/main.css') }}">
</head>

<body>

  <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green navigation
         ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="{{ route ('dashboard') }}" class="sidebar-brand">
      <i class="bi bi-asterisk"></i>
      <span>Agrovalle Honduras</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route ('dashboard') }}" class="sidebar-menu-link" id="menu-overview" title="Overview"
              class="sidebar-menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <i class="bi bi-grid-fill"></i>
              <span>Inicio</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route ('insumos.index') }}" class="sidebar-menu-link" id="menu-overview" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Insumos agropecuarios e inventario</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route ('proveedores.index') }}" class="sidebar-menu-link" id="menu-overview" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Proveedores</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route ('recursoshumanos.index') }}" class="sidebar-menu-link" id="menu-overview" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Recursos Humanos</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Pages -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Paginas</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="#" class="sidebar-menu-link" id="menu-logout" title="Login Page">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Logout</span>
            </a>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="{{ asset ('spark/assets/images/avatar.png') }}" alt="Usuario" class="sidebar-profile-img">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">
        </div>
        <div class="small">Conectado como:</div>
        <div class="sidebar-profile-email">
            {{ Auth::check() ? Auth::user()->email : 'No autenticadoS' }}
        </div>    
      </div>
    </div>
  </div>
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->


  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <!-- Desktop sidebar toggle (visible on large screens only) -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>



        <!-- Mobile sidebar toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>

        <!-- Profile Dropdown -->
        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="profile-dropdown">
            <span class="navbar-profile-name d-none d-md-inline">{{ Auth::check() ? Auth::user()->name : 'Administrador' }}</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Welcome !</li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
      <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </li>
  </ul>
</div>
</div>
  <a href="{{ route('dashboard') }}"
         class="btn-quick-action text-decoration-none ms-auto"
         style="grid-column: 3; justify-self: end;">
        <i class="bi bi-house-door-fill"></i>
        <span>Home</span>
      </a>
    </header>
    </header>
    <!-- END: Top Navbar Component -->

    <!-- START: Page Header Banner -->
  



    <!-- END: Page Header Banner -->
    <div class="container-fluid px-0">
      @yield('content')
    </div>
    <!-- START: Footer Component -->
    <footer class="footer-custom">
      <div class="footer-left">
        <span class="footer-logo">
          <i class="bi bi-flower1"></i> Agrovalle Honduras
        </span>
        <span class="footer-separator">|</span>
        <span class="footer-copy">&copy; 2026 Desarrollado con<i class="bi bi-heart-fill text-danger footer-heart"></i> por<a
            href="#" target="_blank">Natalia Izaguirre </a>• Soluciones Agropecuarias<a

      </div>
      <div class="footer-right">
        <ul class="footer-links">
          <li><a href="{{ route('dashboard') }}" class="footer-link">Inicio</a></li>
          <li><a href="{{ route('insumos.index') }}" class="footer-link">Insumos</a></li>
          <li><a href="{{ route('recursoshumanos.index') }}" class="footer-link">RRHH</a></li>
          <li><a href="{{ route('proveedores.index') }}" class="footer-link">Proveedores</a></li>
        </ul>
      </div>
    </footer>
    <!-- END: Footer Component -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="{{ asset ('spark/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('spark/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset ('spark/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

  <!-- Local dashboard interactions controller -->
  <script src=" {{asset ('spark/assets/js/dashboard.js') }}"></script>
</body>

</html>