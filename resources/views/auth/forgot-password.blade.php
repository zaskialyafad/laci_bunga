@extends('layout.template-page')

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-5">
                        
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Lupa Password?</h3>
                            <p class="text-muted small">
                                Masukkan email yang terdaftar, kami akan mengirimkan link untuk mereset password Anda.
                            </p>
                        </div>

                        {{-- Alert Sukses --}}
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Alamat Email</label>
                                <input type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="nama@email.com" 
                                       required autofocus>
                                
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    Kirim Link Reset
                                </button>
                            </div>

                        </form>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between text-small">
                            <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-bold">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                            </a>
                            <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                Buat Akun Baru
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection