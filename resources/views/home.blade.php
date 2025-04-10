@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .section-title {
      font-size: 2rem;
    }

    .dashboard-card {
      border: none;
      border-radius: 1rem;
      padding: 2rem;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(6px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
      transform: translateY(-3px);
    }

    .candidate-card {
      background: #fff;
      border-radius: 1rem;
      transition: all 0.3s ease;
    }

    .candidate-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }

    .badge-status {
      font-size: 0.9rem;
      padding: 0.45em 1em;
    }

    .card-title {
      font-weight: 600;
      font-size: 1.05rem;
    }

    .modal-content {
      border-radius: 1rem;
    }
  </style>
</head>

<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bold text-dark section-title mb-2">
      <i class="bi bi-house-door-fill text-primary me-2"></i> Dashboard Warga
    </h1>
    <p class="text-secondary fs-5">
      Selamat datang kembali, <span class="fw-semibold text-primary">{{ Auth::user()->name }}</span>! 👋
    </p>
  </div>

  <div class="row g-4">
    <!-- Data Pribadi -->
    <div class="col-md-4">
      <div class="dashboard-card text-center">
        <i class="bi bi-person-badge text-primary fs-2 mb-3"></i>
        <h5 class="card-title mb-2">Data Pribadi</h5>
        <p class="text-muted small">NIK: <strong>{{ Auth::user()->nik }}</strong></p>
      </div>
    </div>

    <!-- Status Warga -->
    <div class="col-md-4">
      <div class="dashboard-card text-center">
        <i class="bi bi-shield-check text-success fs-2 mb-3"></i>
        <h5 class="card-title mb-2">Status Warga</h5>
        <span class="badge badge-status rounded-pill bg-{{ Auth::user()->status === 'aktif' ? 'success' : 'secondary' }}">
          {{ ucfirst(Auth::user()->status) }}
        </span>
      </div>
    </div>

    <!-- Status Pemilihan -->
    <div class="col-md-4">
      <div class="dashboard-card text-center">
        <i class="bi bi-box-seam text-warning fs-2 mb-3"></i>
        <h5 class="card-title mb-2">Status Pemilihan</h5>
        @if(Auth::user()->has_voted)
        <span class="badge badge-status rounded-pill bg-success text-white">
          <i class="bi bi-check-circle-fill me-1"></i> Sudah Memilih
        </span>
        @else
        <a href="{{ route('vote.index') }}" class="badge badge-status rounded-pill bg-warning text-dark text-decoration-none d-inline-flex align-items-center gap-2 shadow-sm">
          <i class="bi bi-ballot-check"></i> Pilih Ketua RT
        </a>
        @endif
      </div>
    </div>
  </div>

  @if($kandidats->count())
  <hr class="my-5">
  <div class="text-center mb-4">
    <h4 class="fw-bold text-dark">👤 Kandidat Ketua RT</h4>
    <p class="text-muted">Berikut adalah kandidat yang telah terdaftar:</p>
  </div>

  <div class="row g-4">
    @foreach($kandidats as $kandidat)
    <div class="col-md-4">
      <div class="card candidate-card shadow-sm h-100 border-0 text-center px-3 pt-4 pb-3">

        <div class="d-flex justify-content-center mb-3">
          <img src="{{ asset('storage/' . $kandidat->foto) }}"
               alt="Foto {{ $kandidat->nama }}"
               class="rounded-circle shadow-sm"
               style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
        </div>

        <div class="card-body px-0">
          <h5 class="card-title text-dark mb-2">{{ $kandidat->nama }}</h5>
          <span class="badge bg-light text-dark fw-normal px-3 py-1 rounded-pill small">
            Kandidat Ketua RT
          </span>
        </div>

        <div class="card-footer bg-transparent border-0 text-center mt-3">
          <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4"
             data-bs-toggle="modal"
             data-bs-target="#modalKandidat{{ $kandidat->id }}">
            <i class="bi bi-person-lines-fill me-1"></i> Lihat Profil
          </a>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKandidat{{ $kandidat->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $kandidat->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white border-0">
            <h5 class="modal-title fw-semibold" id="modalLabel{{ $kandidat->id }}">
                <i class="bi bi-person-circle me-2"></i> Profil Kandidat
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $kandidat->foto) }}"
                    alt="Foto {{ $kandidat->nama }}"
                    class="rounded-circle shadow"
                    style="width: 140px; height: 140px; object-fit: cover; border: 4px solid #fff; margin-top: -80px; background-color: #fff;">
                <h5 class="mt-3 mb-0 fw-bold text-dark">{{ $kandidat->nama }}</h5>
                <small class="text-muted">Kandidat Ketua RT</small>
            </div>
    
            <div class="row mt-4 g-4">
                <div class="col-md-6">
                <div>
                    <h6 class="text-primary fw-bold">Visi</h6>
                    <p class="text-muted">{{ $kandidat->visi }}</p>
                </div>
                </div>
                <div class="col-md-6">
                <div>
                    <h6 class="text-success fw-bold">Misi</h6>
                    <p class="text-muted">{{ $kandidat->misi }}</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>  
    @endforeach
  </div>
  @endif
</div>
@endsection
