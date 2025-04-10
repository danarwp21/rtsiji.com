<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - E-Voting RTSIJI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background: url('{{ asset('storage/background.png') }}') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-login {
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.9);
      padding: 2rem;
      border-radius: 1.5rem;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 420px;
      transition: all 0.3s ease-in-out;
    }

    .card-login:hover {
      transform: scale(1.01);
    }

    .form-label {
      font-weight: 600;
    }

    .form-control {
      border-radius: 0.75rem;
      padding-left: 2.5rem;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.2);
    }

    .input-icon {
      position: absolute;
      top: 50%;
      left: 1rem;
      transform: translateY(-50%);
      color: #888;
    }

    .form-group {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 1rem;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }

    .btn-primary {
      border-radius: 0.75rem;
      font-weight: bold;
      padding: 0.6rem;
    }

    .title {
      text-align: center;
      font-size: 1.7rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: #0d6efd;
    }

    .logo-wrapper {
      text-align: center;
      margin-bottom: 1rem;
    }

    .logo-wrapper img {
      height: 60px;
    }

    .back-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="card-login">
    <div class="logo-wrapper">
      <img src="{{ asset('storage/logo.png') }}" alt="Logo RT">
    </div>
    {{-- <div class="title">Login E-Voting RTSIJI</div> --}}

    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $e)
          <div>{{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3 form-group">
        <i class="bi bi-person-fill input-icon"></i>
        <label for="nik" class="form-label">NIK</label>
        <input type="text" id="nik" name="nik" class="form-control" placeholder="Masukkan NIK" required autofocus>
      </div>
      <div class="mb-3 form-group">
        <i class="bi bi-lock-fill input-icon"></i>
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
        <i class="bi bi-eye-slash-fill toggle-password" id="togglePassword"></i>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>
      </div>
    </form>

    <div class="back-link">
      <a href="/" class="text-decoration-none text-primary">&larr; Kembali ke Beranda</a>
    </div>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      this.classList.toggle('bi-eye-fill');
      this.classList.toggle('bi-eye-slash-fill');
    });
  </script>
</body>
</html>
