<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .navbar-logo-wrapper {
    background-color: #ffffff;
    padding: 6px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    margin-right: 10px;
  }

  .navbar-logo {
    height: 48px;
    width: auto;
    display: block;
  }

  .navbar-dark .nav-link {
    transition: 0.3s ease;
  }

  .navbar-dark .nav-link:hover {
    color: #ffc107 !important;
  }

  .navbar-dark .btn-outline-light:hover {
    background-color: #ffc107;
    color: #000;
    border-color: #ffc107;
  }

  @media (max-width: 767.98px) {
    .navbar-logo-wrapper {
      padding: 4px;
      height: 42px;
    }
    .navbar-logo {
      height: 40px;
    }
    .navbar-nav {
      text-align: center;
    }
    .navbar-nav .nav-item {
      margin-bottom: 0.75rem;
    }
    .navbar-nav img {
      margin-bottom: 0.5rem;
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1f2d3d;">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center text-warning" href="{{ url('/') }}">
      <div class="navbar-logo-wrapper">
        <img src="{{ asset('storage/logo.png') }}" alt="Logo RT SIJI" class="navbar-logo" />
      </div>
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list fs-2 text-warning"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center gap-lg-3">
        @guest
          <li class="nav-item">
            <a class="nav-link text-light fw-semibold" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-warning btn-sm px-3 fw-bold shadow-sm" href="{{ route('register') }}">
              <i class="bi bi-person-plus-fill me-1"></i> Daftar
            </a>
          </li>
        @else
          <li class="nav-item text-center d-flex flex-column flex-lg-row align-items-center">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=32"
                 class="rounded-circle border border-light mb-2 mb-lg-0 me-lg-2" width="32" height="32" alt="Avatar">
            <span class="text-light fw-semibold">{{ Auth::user()->name }}</span>
          </li>
          <li class="nav-item text-center">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-sm px-3 fw-semibold shadow-sm mt-2 mt-lg-0">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
              </button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
