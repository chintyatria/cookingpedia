@extends('layouts.main')

@section('container')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <main class="form-signin">

                <h1 class="h3 mb-3 fw-normal text-center"><img class="mb-0" src="/img/icon-chef.png" alt="logo" width="100"> Masuk Akun</h1>

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
    
                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Alamat Email" autofocus required>
                        <label for="email" style="color: rgba(0, 0, 0, 0.5)">Alamat Email</label>
                        <div class="invalid-feedback">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password" style="color: rgba(0, 0, 0, 0.5)">Password</label>
                        <div class="invalid-feedback">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk Akun</button>
                    {{-- <p class="mt-2 mb-3 text-muted">&copy; CookingPedia 2022</p> --}}
                </form>
                <small class="d-block text-center mt-4">Belum Punya Akun? <a href="/register" class="text-decoration-none">Daftar Sekarang!</a></small>
            </main>
        </div>
    </div>

    
@endsection