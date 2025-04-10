@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ url('/home') }}" class="btn btn-outline-dark rounded-pill shadow-sm d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle me-2"></i> Kembali ke Beranda
        </a>
    </div>

    <div class="text-center mb-5">
        <h2 class="fw-bold text-gradient display-5">
            <i class="bi bi-person-check-fill me-2"></i> Pemilihan Ketua RT
        </h2>
        <p class="text-muted fs-5">Pilih kandidat terbaik yang siap membawa perubahan positif bagi lingkungan kita.</p>
    </div>

    <div class="row g-4 justify-content-center">
        @php
            $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
        @endphp

        @forelse($kandidats as $index => $kandidat)
        @php
            $color = $colors[$index % count($colors)];
        @endphp
        <div class="col-md-4 d-flex">
            <form method="POST" action="{{ route('vote.store') }}" class="w-100 vote-form">
                @csrf
                <input type="hidden" name="kandidat_id" value="{{ $kandidat->id }}">

                <div class="card candidate-modern shadow border-0 rounded-4 d-flex flex-column h-100 text-center p-3 position-relative overflow-hidden">
                    <div class="candidate-photo d-flex justify-content-center mt-4 position-relative">
                        <span class="candidate-badge bg-{{ $color }}">No. {{ $index + 1 }}</span>
                        <img src="{{ asset('storage/' . $kandidat->foto) }}"
                             alt="Foto {{ $kandidat->nama }}"
                             class="rounded-circle candidate-img">
                    </div>

                    <div class="card-body d-flex flex-column px-3 mt-3">
                        <h5 class="fw-bold text-dark mb-1 card-title">{{ $kandidat->nama }}</h5>
                        <p class="text-muted small mb-2"><i class="bi bi-lightbulb me-1 text-warning"></i> <strong>Visi:</strong> {{ \Illuminate\Support\Str::limit($kandidat->visi, 80) }}</p>
                        <p class="text-muted small"><i class="bi bi-check2-all me-1 text-success"></i> <strong>Misi:</strong> {{ \Illuminate\Support\Str::limit($kandidat->misi, 80) }}</p>
                        <div class="mt-auto"></div>
                    </div>

                    <div class="card-footer bg-transparent border-0 px-3 pb-4">
                        <button type="submit" class="btn btn-outline-primary w-100 rounded-pill fw-semibold shadow-sm vote-button">
                            <i class="bi bi-check2-circle me-1"></i> Pilih Kandidat Ini
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center" role="alert">
                Belum ada kandidat yang terdaftar.
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .candidate-modern {
        transition: all 0.35s ease-in-out;
        background: #ffffff;
        border-radius: 1.5rem;
    }

    .candidate-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .candidate-photo {
        position: relative;
    }

    .candidate-img {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .candidate-modern:hover .candidate-img {
        transform: scale(1.05);
    }

    .candidate-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        z-index: 2;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .text-gradient {
        background: linear-gradient(to right, #2563eb, #1e40af);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .vote-button {
        transition: all 0.2s ease;
    }

    .vote-button:hover {
        transform: scale(1.02);
    }

    .card-title {
        font-size: 1.2rem;
    }

    .card-body p {
        font-size: 0.95rem;
    }

    @media (max-width: 767px) {
        .candidate-img {
            width: 100px;
            height: 100px;
        }

        .candidate-badge {
            font-size: 0.7rem;
        }
    }
</style>

{{-- SweetAlert JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.vote-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const nama = this.querySelector('.card-title')?.textContent?.trim();

            Swal.fire({
                title: 'Konfirmasi Pilihan',
                text: `Anda yakin ingin memilih "${nama}" sebagai Ketua RT?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pilih',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
