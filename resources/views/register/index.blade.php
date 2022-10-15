@extends('layouts.main')

@section('container')

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center"><img class="mb-0" src="/img/icon-chef.png" alt="logo" width="100"> Daftar Akun</h1>
                <form action="/register" method="POST">
                    @csrf
    
                    <div class="form-floating mb-2">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Lengkap" autofocus required value="{{ old('name') }}">
                        <label for="name" style="color: rgba(0, 0, 0, 0.5)">Nama Lengkap</label>
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username/ Nama Pengguna" required value="{{ old('username') }}">
                        <label for="username" style="color: rgba(0, 0, 0, 0.5)">Username/ Nama Pengguna</label>
                        <div class="invalid-feedback">
                            @error('username')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
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
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Daftar Akun</button>
                    {{-- <p class="mt-2 mb-3 text-muted">&copy; CookingPedia 2022</p> --}}
                </form>
                <small class="d-block text-center mt-4">Sudah Punya Akun? <a href="/login" class="text-decoration-none">Masuk</a></small>
            </main>
        </div>
    </div>

    
@endsection