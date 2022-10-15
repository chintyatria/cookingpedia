@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tulis resep</h1>
    </div>

    <div class="col-lg-8">

        <form method="POST" action="/dashboard/reseps" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judul_resep" class="form-label">Judul Resep</label>
                <input type="text" class="form-control @error('judul_resep') is-invalid @enderror" id="judul_resep" name="judul_resep" required autofocus value="{{ old('judul_resep') }}">
                @error('judul_resep')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" name="kategori_id">
                    @foreach ($kategoris as $kategori)
                        @if (old('kategori_id') == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                        @else
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Masukkan Gambar Masakan Anda</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="resepnya" class="form-label">Tulis Resep Kreasi Anda</label>
                @error('resepnya')
                    <p class="text-danger"> {{ $message }}</p>
                @enderror
                <input id="resepnya" type="hidden" name="resepnya" value="{{ old('resepnya') }}">
                <trix-editor input="resepnya"></trix-editor>
            </div>
            <a href="/dashboard/reseps" class="btn btn-success my-2"><span data-feather="arrow-left"></span> Kembali</a>
            <button type="submit" class="btn btn-primary" style="float:right;">Kirim</button>
        </form>

    </div>

    <script>
        const judul_resep = document.querySelector('#judul_resep');
        const slug = document.querySelector('#slug');

        judul_resep.addEventListener('change', function(){
            fetch('/dashboard/reseps/cekSlug?judul_resep=' + judul_resep.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })

        function previewImage() {
            const gambar = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');
            
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
