@extends('layouts.main')

@section('container') 

    <h1 class="mb-5 text-center">{{ $title }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/reseps">
                @csrf
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                @if (request('chef'))
                    <input type="hidden" name="chef" value="{{ request('chef') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Pencarian..." name="cari" value="{{ request('cari') }}">
                    <button class="btn btn-danger" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
 
    @if ($reseps->count())
        <div class="card mb-3">
            @if ($reseps[0]->gambar)
                <div style="max-height: 350px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $reseps[0]->gambar) }}" alt="{{ $reseps[0]->kategori->nama }}" class="img-fluid">
                </div>
             @else
                <img src="https://source.unsplash.com/1200x400?{{ $reseps[0]->kategori->nama }}" class="card-img-top" alt="{{ $reseps[0]->kategori->nama }}">
            @endif
            
            <div class="card-body text-center">
                <h3 class="card-title"><a href="/reseps/{{ $reseps[0]->slug }}" class="text-decoration-none text-dark">{{ $reseps[0]->judul_resep }}</a></h3>
                <p>
                    <small class="text-muted">
                        By Chef: <a href="/reseps?chef={{ $reseps[0]->chef->username }}" class="text-decoration-none">{{ $reseps[0]->chef->name }}</a> in 
                        <a href="/reseps?kategori={{ $reseps[0]->kategori->slug }}" class="text-decoration-none">{{ $reseps[0]->kategori->nama }}</a> 
                        {{ $reseps[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{{ $reseps[0]->deskripsi }}</p>
                <a href="/reseps/{{ $reseps[0]->slug }}" class="text-decoration-none btn btn-primary">Recook</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($reseps->skip(1) as $resep)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0,0,0,0.7);"><a href="/reseps?kategori={{ $resep->kategori->slug }}" class="text-white text-decoration-none">{{ $resep->kategori->nama }}</a></div>
                            @if ($reseps[0]->gambar)
                                    <img src="{{ asset('storage/' . $reseps[0]->gambar) }}" alt="{{ $reseps[0]->kategori->nama }}" class="img-fluid">
                            @else
                                <img src="https://source.unsplash.com/500x400?{{ $resep->kategori->nama }}" class="card-img-top" alt="{{ $resep->kategori->nama }}">
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $resep->judul_resep }}</h5>
                                <p>
                                    <small class="text-muted">
                                        By Chef: <a href="/reseps?chef={{ $resep->chef->username }}" class="text-decoration-none">{{ $resep->chef->name }}</a> 
                                        {{ $resep->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ $resep->deskripsi }}</p>
                                <a href="/reseps/{{ $resep->slug }}" class="btn btn-primary">Recook</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">Resep Tidak Ditemukan..</p>
    @endif

    <div class="d-flex justify-content-center">
        {{ $reseps->links() }}
    </div>

    

@endsection