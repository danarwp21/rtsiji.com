@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ url('/admin') }}" class="btn btn-outline-dark rounded-pill shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    {{-- Judul --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success display-5 mb-2">
            <i class="bi bi-bar-chart-line-fill me-2"></i> Hasil Pemilihan Ketua RT
        </h2>
        <p class="text-muted fs-5">Rekapitulasi akhir hasil pemilihan berdasarkan suara yang masuk.</p>
    </div>

    {{-- Chart --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-5 p-4 glass-effect">
                <canvas id="voteChart" height="140"></canvas>
            </div>
        </div>
    </div>

    {{-- Kandidat Cards --}}
    <div class="row g-4">
        @php
            $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
        @endphp
        @foreach ($kandidates as $index => $kandidate)
        @php
            $color = $colors[$index % count($colors)];
        @endphp
        <div class="col-md-4 d-flex">
            <div class="card rounded-4 shadow-sm border-0 h-100 w-100 position-relative overflow-hidden candidate-card border-start border-4 border-{{ $color }} {{ $kandidate->id == $winner_id ? 'border-success border-4' : '' }}">
                
                @if ($kandidate->id == $winner_id)
                    <div class="position-absolute top-0 end-0 bg-success text-white px-3 py-2 fw-semibold rounded-bottom-start shadow-sm" style="z-index: 10;">
                        🏆 Pemenang
                    </div>
                @endif

                <img src="{{ asset('storage/' . $kandidate->foto) }}" class="card-img-top rounded-top"
                    alt="{{ $kandidate->nama }}" style="height: 240px; object-fit: cover;">

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="fw-bold text-dark mb-2">{{ $kandidate->nama }}</h5>
                    <p class="text-muted small mb-3">Jumlah Suara: <strong>{{ $kandidate->votes_count }}</strong></p>

                    <div class="progress rounded-pill" style="height: 10px;">
                        <div class="progress-bar bg-{{ $color }}" role="progressbar"
                            style="width: {{ $totalVotes > 0 ? ($kandidate->votes_count / $totalVotes) * 100 : 0 }}%;"
                            aria-valuenow="{{ $kandidate->votes_count }}" aria-valuemin="0" aria-valuemax="{{ $totalVotes }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    setInterval(() => {
        location.reload();
    }, 5000);
</script>
<script>
    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($kandidates->pluck('nama')) !!},
            datasets: [{
                label: 'Jumlah Suara',
                data: {!! json_encode($kandidates->pluck('votes_count')) !!},
                backgroundColor: {!! json_encode($kandidates->pluck('id')->map(function ($_, $i) use ($colors) {
                    return 'rgba(' . ($i * 30 + 50) . ', ' . (150 - $i * 15) . ', 200, 0.6)';
                })) !!},
                borderColor: {!! json_encode($kandidates->pluck('id')->map(function ($_, $i) use ($colors) {
                    return 'rgba(' . ($i * 30 + 50) . ', ' . (150 - $i * 15) . ', 200, 1)';
                })) !!},
                borderWidth: 2,
                borderRadius: 12,
                barPercentage: 0.6,
                categoryPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#000',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>

{{-- Custom CSS --}}
<style>
    .candidate-card {
        transition: all 0.3s ease-in-out;
        background: #fff;
    }

    .candidate-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.08);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .progress {
        background-color: #f0f0f0;
    }

    .progress-bar {
        transition: width 1s ease;
    }
</style>
@endsection
