@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <h2 class="mb-4 text-primary fw-bold animate__animated animate__fadeInDown">
        <i class="fas fa-user-plus me-2"></i> Tambah Pengguna
    </h2>

    <form action="{{ route('pengguna.store') }}" method="POST" class="animate__animated animate__fadeInUp" novalidate>
        @csrf
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">Email:</label>
            <input type="email" id="email" name="email" class="form-control shadow-sm" placeholder="Masukkan email" required>
            <div class="invalid-feedback">
                Mohon masukkan email yang valid.
            </div>
        </div>

        <div class="mb-4 position-relative">
            <label for="password" class="form-label fw-semibold">Password:</label>
            <input type="password" id="password" name="password" class="form-control shadow-sm pe-5" placeholder="Masukkan password" required minlength="6">
            <!-- Icon mata untuk toggle -->
            <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor: pointer; user-select: none;" id="togglePassword">
                <i class="fas fa-eye"></i>
            </span>
            <div class="invalid-feedback">
                Password harus minimal 6 karakter.
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success shadow-sm btn-animate">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary shadow-sm btn-animate">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </form>
</div>

<!-- Validasi sederhana dengan Bootstrap -->
<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('form')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })

        // Toggle password visibility
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Toggle icon
            togglePassword.innerHTML = type === 'password'
                ? '<i class="fas fa-eye"></i>'
                : '<i class="fas fa-eye-slash"></i>';
        });
    })()
</script>

<style>
    .btn-animate {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-animate:hover, .btn-animate:focus {
        transform: scale(1.05);
        box-shadow: 0 0.5rem 1rem rgba(0, 128, 0, 0.25);
        z-index: 2;
    }
    input.form-control:focus {
        box-shadow: 0 0 8px rgba(25, 135, 84, 0.5);
        border-color: #198754;
    }
    /* Buat ikon mata lebih halus saat hover */
    #togglePassword i {
        color: #6c757d;
        transition: color 0.3s ease;
    }
    #togglePassword:hover i {
        color: #198754;
    }
</style>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@endsection
