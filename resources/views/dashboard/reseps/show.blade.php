@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1>{{ $resep->judul_resep }}</h1>

                <a href="/dashboard/reseps" class="btn btn-success mt-4"><span data-feather="arrow-left"></span> Kembali</a>
                <a href="/dashboard/reseps/{{ $resep->slug }}/edit" class="btn btn-warning mt-4"><span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/reseps/{{ $resep->slug }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger mt-4" onclick="return confirm('Anda Yakain Akan MENGHAPUS Resep?')"><span data-feather="trash-2"></span> Hapus</button>
                </form>

                @if ($resep->gambar)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->kategori->nama }}" class="img-fluid mt-3">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $resep->kategori->nama }}" alt="{{ $resep->kategori->nama }}" class="img-fluid mt-3">
                @endif


                <article class="my-3 fs-5">
                    {!! $resep->resepnya !!}
                </article>
            </div>
        </div>
    </div>
@endsection
