@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold mb-3">Tambah Kandidat Baru</h4>
            <form method="POST" action="{{ route('admin.store') }}" class="bg-light p-4 rounded shadow-sm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kandidat</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="vision" class="form-label">Visi</label>
                    <input type="text" name="vision" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mission" class="form-label">Misi</label>
                    <input type="text" name="mission" class="form-control" required>
                </div>
                <button class="btn btn-success w-100">Simpan Kandidat</button>
            </form>
        </div>

        <div class="col-md-6">
            <h4 class="fw-bold mb-3">Hasil Sementara</h4>
            <div class="list-group shadow-sm">
                @foreach($candidates as $c)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $c->name }}</strong>
                            <div class="text-muted small">Visi: {{ $c->vision }}</div>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $c->votes }} suara</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
