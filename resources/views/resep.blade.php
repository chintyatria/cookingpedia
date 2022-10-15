@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1>{{ $data_resep->judul_resep }}</h1>

                <p>By Chef: <a href="/reseps?chef={{ $data_resep->chef->username }}" class="text-decoration-none">{{ $data_resep->chef->name }}</a> in 
                <a href="/reseps?kategori={{ $data_resep->kategori->slug }}" class="text-decoration-none">{{ $data_resep->kategori->nama }}</a></p>

                @if ($data_resep->gambar)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $data_resep->gambar) }}" alt="{{ $data_resep->kategori->nama }}" class="img-fluid">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $data_resep->kategori->nama }}" alt="{{ $data_resep->kategori->nama }}" class="img-fluid">
                @endif
                 

                <article class="my-3 fs-5">
                    {!! $data_resep->resepnya !!}
                </article>

                {{-- <a href="/reseps" class="text-decoration-none">Back</a> --}}
                <a href="/reseps" class="btn btn-success mt-4"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

@endsection
