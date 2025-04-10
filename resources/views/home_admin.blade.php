@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
<head>
    <style>
        .candidate-card:hover img {
            transform: scale(1.03);
        }

        .candidate-card {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
        }

        .candidate-card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px);
        }

        .candidate-img {
            height: 240px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
    </style>
</head>

<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Dashboard Admin</h2>
        <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong> 👨‍💼</p>
    </div>

    {{-- Statistik --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-center h-100">
                <div class="card-body py-4">
                    <i class="bi bi-people-fill text-primary fs-1 mb-2"></i>
                    <h5 class="card-title">Total Warga</h5>
                    <p class="card-text fs-4 fw-semibold">{{ $totalWarga }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-center h-100">
                <div class="card-body py-4">
                    <i class="bi bi-check2-circle text-success fs-1 mb-2"></i>
                    <h5 class="card-title">Sudah Memilih</h5>
                    <p class="card-text fs-4 fw-semibold">{{ $sudahMemilih }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-center h-100">
                <div class="card-body py-4">
                    <i class="bi bi-x-circle text-danger fs-1 mb-2"></i>
                    <h5 class="card-title">Belum Memilih</h5>
                    <p class="card-text fs-4 fw-semibold">{{ $belumMemilih }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Lihat Rekapitulasi --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6 offset-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-center h-100 position-relative">
                <div class="card-body py-4">
                    <i class="bi bi-graph-up-arrow text-success fs-1 mb-3"></i>
                    <h5 class="fw-bold text-dark mb-2">Lihat Hasil Pemilihan</h5>
                    <p class="text-muted small mb-3">Klik tombol di bawah untuk melihat rekapitulasi hasil suara secara real-time.</p>
                    <a href="{{ route('vote.report') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
                        <i class="bi bi-bar-chart-fill me-1"></i> Lihat Rekapitulasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Warga --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-dark mb-0">📋 Daftar Warga</h5>
        <a href="{{ route('kandidate.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Input Kandidat
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Memilih</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($data as $index => $w)
                        <tr>
                            <td>{{ $data->firstItem() + $index }}</td>
                            <td>{{ $w->nik }}</td>
                            <td>{{ $w->name }}</td>
                            <td>
                                <span class="badge bg-{{ $w->status == 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($w->status) }}
                                </span>
                            </td>
                            <td>
                                @if($w->has_voted)
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                @else
                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data warga.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>

    {{-- Daftar Kandidat --}}
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
