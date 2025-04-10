@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-success text-white text-center rounded-top-4">
                <h4 class="mb-0">Daftar Sebagai Warga RT</h4>
            </div>

            <div class="card-body px-4 py-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control rounded-pill px-3"
                               name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label fw-semibold">NIK</label>
                        <input id="nik" type="text" class="form-control rounded-pill px-3"
                               name="nik" value="{{ old('nik') }}" required minlength="16" maxlength="16">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" class="form-control rounded-pill px-3"
                               name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input id="password-confirm" type="password" class="form-control rounded-pill px-3"
                               name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-pill py-2 fw-semibold">
                            Daftar Sekarang
                        </button>
                    </div>

                    <div class="text-center mt-3 small">
                        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
