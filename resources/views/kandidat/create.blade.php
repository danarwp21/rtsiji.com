@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Tambah Kandidat Baru</h5>
                    <a href="{{ route('admin') }}" class="btn btn-sm btn-light text-primary fw-bold">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('kandidate.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Kandidat</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="visi" class="form-label fw-semibold">Visi</label>
                            <textarea name="visi" id="visi" rows="3" class="form-control @error('visi') is-invalid @enderror" placeholder="Tulis visi kandidat..." required></textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="misi" class="form-label fw-semibold">Misi</label>
                            <textarea name="misi" id="misi" rows="3" class="form-control @error('misi') is-invalid @enderror" placeholder="Tulis misi kandidat..." required></textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold">Foto Kandidat</label>
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" required>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Preview Foto -->
                            <div id="foto-preview" class="mt-3 text-center"></div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-send-check me-1"></i> Simpan Kandidat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Preview Foto
        const fotoInput = document.getElementById('foto');
        const previewContainer = document.getElementById('foto-preview');

        fotoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.innerHTML = `
                        <img src="${e.target.result}" alt="Preview Foto" class="img-thumbnail rounded-4 shadow-sm" style="max-height: 200px;">
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        });

        // Validasi Realtime
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.checkValidity()) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                }
            });
        });
    });
</script>
@endpush
