@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">Data Warga</h2>
            <p class="text-muted mb-0">Daftar warga RT yang terdaftar dalam sistem.</p>
        </div>
        <a href="{{ route('admin') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="wargaTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Status Memilih</th>
                            <th>Waktu Memilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $warga)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $warga->name }}</td>
                                <td>{{ $warga->nik }}</td>
                                <td>
                                    @if($warga->has_voted)
                                        <span class="badge bg-success rounded-pill">Sudah</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    @if($warga->has_voted && $warga->voted_at)
                                        {{ \Carbon\Carbon::parse($warga->voted_at)->translatedFormat('l, d F Y H:i') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>                           
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data warga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#wargaTable').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                },
                zeroRecords: "Tidak ditemukan data yang sesuai",
            }
        });
    });
</script>
@endpush
