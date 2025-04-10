<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .navbar-custom {
    background-color: #1f2d3d;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  }

  .navbar-logo-wrapper {
    /* background: #fff; */
    padding: 4px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    margin-right: 10px;
  }

  .navbar-logo {
    height: 50px;
    width: auto;
  }

  .navbar-nav .nav-link {
    color: #f8f9fa;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
  }

  .navbar-nav .nav-link:hover {
    color: #ffc107;
  }

  .btn-custom-yellow {
    background-color: #ffc107;
    color: #000;
    font-weight: 600;
    border: none;
  }

  .btn-custom-yellow:hover {
    background-color: #e0ac00;
    color: #000;
  }

  @media (max-width: 767.98px) {
    .navbar-logo {
      height: 36px;
    }

    .navbar-nav {
      text-align: center;
    }

    .navbar-nav .nav-item {
      margin-bottom: 0.75rem;
    }

    .navbar-toggler {
      border: none;
    }

    .navbar-toggler:focus {
      outline: none;
      box-shadow: none;
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-2">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center text-warning fw-bold">
        <div class="navbar-logo-wrapper shadow-sm me-2">
          <img src="{{ asset('storage/logo.png') }}" alt="Logo E-Voting RT SIJI" class="navbar-logo" />
        </div>
        {{-- <span class="d-none d-md-inline fs-5">RT SIJI</span> --}}
    </a>      

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list fs-2 text-warning"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <ul class="navbar-nav align-items-center gap-lg-3">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-custom-yellow px-3 shadow-sm" href="{{ route('register') }}">
              <i class="bi bi-person-plus-fill me-1"></i> Daftar
            </a>
          </li>
        @else
          <li class="nav-item d-flex align-items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=32"
                 class="rounded-circle border border-light" width="32" height="32" alt="Avatar">
            <span class="text-light fw-semibold">{{ Auth::user()->name }}</span>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-light fw-semibold px-3 shadow-sm">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
              </button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
