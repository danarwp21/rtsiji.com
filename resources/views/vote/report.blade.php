@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ url('/admin') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
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

    {{-- Chart Donut --}}
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 p-4 glass-effect h-100">
                <h5 class="fw-bold text-center mb-3">Quick Count</h5>
                <div class="chart-wrapper mx-auto">
                    <canvas id="votePieChart"></canvas>
                </div>
                <p class="text-center text-muted mt-3 mb-0">
                    Total Suara Masuk: <strong>{{ $totalVotes }}</strong>
                </p>
            </div>
        </div>
    </div>

    {{-- Kartu Kandidat --}}
    <div class="row g-4 justify-content-center">
        @php
            $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
        @endphp
        @foreach ($kandidates as $index => $kandidate)
        @php
            $color = $colors[$index % count($colors)];
            $percentage = $totalVotes > 0 ? number_format(($kandidate->votes_count / $totalVotes) * 100, 1) : '0.0';
        @endphp
        <div class="col-md-4 d-flex">
            <div class="card candidate-card text-center shadow-sm border-0 w-100 p-4 position-relative {{ $kandidate->id == $winner_id ? 'border-success border-2' : '' }}">
                @if ($kandidate->id == $winner_id)
                    <div class="winner-badge">🥇</div>
                @endif

                <div class="candidate-avatar mx-auto mb-3">
                    <img src="{{ asset('storage/' . $kandidate->foto) }}" alt="{{ $kandidate->nama }}">
                </div>

                <h5 class="fw-bold mb-1">{{ $kandidate->nama }}</h5>
                <p class="text-muted small mb-1">
                    Jumlah Suara: <strong>{{ $kandidate->votes_count }}</strong>
                </p>
                <p class="text-dark fw-semibold mb-2">{{ $percentage }}%</p>

                <div class="progress rounded-pill">
                    <div class="progress-bar bg-{{ $color }}" role="progressbar"
                        style="width: {{ $percentage }}%;"
                        aria-valuenow="{{ $kandidate->votes_count }}" aria-valuemin="0" aria-valuemax="{{ $totalVotes }}">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
    setInterval(() => {
        location.reload();
    }, 5000);

    const pieCtx = document.getElementById('votePieChart').getContext('2d');
    const votePieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($kandidates->pluck('nama')) !!},
            datasets: [{
                data: {!! json_encode($kandidates->pluck('votes_count')) !!},
                backgroundColor: {!! json_encode($kandidates->pluck('id')->map(function ($_, $i) {
                    return 'hsl(' . ($i * 60) . ', 70%, 60%)';
                })) !!},
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let value = context.raw;
                            let percentage = ((value / total) * 100).toFixed(1);
                            return `${context.label}: ${value} suara (${percentage}%)`;
                        }
                    }
                },
                datalabels: {
                    color: '#000',
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        return `${percentage}%`;
                    },
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>

{{-- Custom CSS --}}
<style>
    html {
        scroll-behavior: smooth;
    }

    .candidate-card {
        border-radius: 16px;
        background: #fefefe;
        transition: all 0.2s ease-in-out;
    }

    .candidate-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .candidate-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #f0f0f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .candidate-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .winner-badge {
        position: absolute;
        top: -12px;
        right: -12px;
        background: gold;
        color: white;
        font-size: 1.4rem;
        border-radius: 50%;
        padding: 8px 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .progress {
        height: 12px;
        background-color: #eaeaea;
    }

    .progress-bar {
        transition: width 1s ease;
    }

    .chart-wrapper {
        position: relative;
        width: 100%;
        max-width: 340px;
        height: 340px;
        margin: 0 auto;
    }
</style>
@endsection
