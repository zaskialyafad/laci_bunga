@extends('layout.template-page')

@section('content')

{{-- Section Background Abu-abu --}}
<section class="d-flex align-items-center min-vh-100 py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5"> 
                
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body p-5">
                        
                        {{-- Header Register --}}
                        <div class="text-center mb-4">
                            <h1 class="h3 text-gray-900 fw-bold mb-2">Buat Akun Baru!</h1>
                            <p class="text-muted small">Daftar sekarang untuk mulai berbelanja</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="user">
                            @csrf

                            {{-- Name Input --}}
                            <div class="mb-3">
                                <label for="name" class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required autofocus autocomplete="name"
                                       placeholder="Masukan Nama Lengkap...">
                                
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email Input --}}
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-bold text-muted">Alamat Email</label>
                                <input type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required autocomplete="username"
                                       placeholder="Masukan Alamat Email...">
                                
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Row Password (Side by Side) --}}
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="password" class="form-label small fw-bold text-muted">Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required autocomplete="new-password"
                                           placeholder="Password">
                                    
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="password_confirmation" class="form-label small fw-bold text-muted">Ulangi Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required autocomplete="new-password"
                                           placeholder="Ulangi Password">
                                </div>
                            </div>

                            {{-- Tombol Register --}}
                            <div class="d-grid gap-2 mt-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                    Daftar Sekarang
                                </button>
                            </div>

                        </form>

                        <hr class="my-4">

                        {{-- Links --}}
                        <div class="text-center mb-2">
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none" href="{{ route('password.request') }}">Lupa Password?</a>
                            @endif
                        </div>
                        
                        <div class="text-center">
                            <span class="small text-muted">Sudah punya akun?</span>
                            <a class="small text-decoration-none fw-bold" href="{{ route('login') }}">Login disini!</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection