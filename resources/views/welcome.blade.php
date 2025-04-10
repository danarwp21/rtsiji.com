<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" type="image/png" href="{{ asset('storage/logo.png') }}">
  <title>E-Voting RTSIJI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #f0f4ff, #f8fafc);
      color: #1f2937;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .hero-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 20px;
      position: relative;
      overflow: hidden;
    }

    .hero-glow {
      position: absolute;
      top: -50px;
      left: -80px;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
      border-radius: 50%;
      z-index: 0;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      background: white;
      padding: 48px;
      border-radius: 24px;
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.06);
      text-align: center;
      max-width: 720px;
      width: 100%;
      transition: 0.3s;
    }

    .hero-content:hover {
      transform: scale(1.01);
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);
    }

    .logo {
      height: 60px;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 2.75rem;
      font-weight: 800;
      color: #1d4ed8;
      margin-bottom: 20px;
    }

    .lead {
      font-size: 1.15rem;
      color: #475569;
      margin-bottom: 30px;
    }

    .btn-start {
      background: linear-gradient(to right, #2563eb, #1d4ed8);
      color: white;
      font-weight: 600;
      padding: 14px 32px;
      font-size: 1rem;
      border-radius: 14px;
      text-decoration: none;
      box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
      transition: all 0.3s ease;
    }

    .btn-start:hover {
      transform: translateY(-2px);
      background: #1e40af;
    }

    footer {
      background-color: #1e293b;
      color: #94a3b8;
      padding: 18px 24px;
      text-align: center;
      font-size: 0.85rem;
      margin-top: auto;
    }

    @media (max-width: 576px) {
      h1 {
        font-size: 2rem;
      }

      .hero-content {
        padding: 32px 20px;
      }

      .btn-start {
        font-size: 0.95rem;
        padding: 12px 24px;
      }
    }
  </style>
</head>
<body>

  <div class="hero-container">
    <div class="hero-glow"></div>
    <div class="hero-content">
      <img src="{{ asset('storage/logo.png') }}" alt="Logo RT SIJI" class="logo" />
      <h1>Selamat Datang di E-Voting RT SIJI</h1>
      <p class="lead">Transformasi pemilu RT berbasis digital — cepat, aman, dan transparan. Yuk, mulai partisipasi dengan teknologi.</p>
      <a href="{{ route('login') }}" class="btn-start">Masuk dan Mulai Pilih</a>
    </div>
  </div>

  <footer>
    &copy; {{ date('Y') }} E-Voting RTSIJI — Dibangun oleh warga. Untuk warga. Dengan semangat digital.
  </footer>

</body>
</html>
