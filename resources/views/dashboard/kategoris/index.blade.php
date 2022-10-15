@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Kategori</h1>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success col-lg-6" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg-6">
        <a href="/dashboard/kategoris/create" class="btn btn-primary mb-3">Tambah Data</a>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($kategoris as $kategori)
            
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $kategori->nama }}</td>
              <td>
                <a href="/dashboard/kategoris/{{ $kategori->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <a href="/dashboard/kategoris/{{ $kategori->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <form action="/dashboard/kategori/{{ $kategori->slug }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf

                  <button class="badge bg-danger border-0" onclick="return confirm('Anda Yakain Akan MENGHAPUS Resep?')"><span data-feather="trash-2"></span></button>
                </form>
              </td>
            </tr>

            @endforeach

          </tbody>
        </table>
    </div>
@endsection
