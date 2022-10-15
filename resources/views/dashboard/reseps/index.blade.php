@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Resep Saya</h1>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Judul Resep</th>
              <th scope="col">Kategori</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($reseps as $resep)
            
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $resep->judul_resep }}</td>
              <td>{{ $resep->kategori->nama }}</td>
              <td>
                <a href="/dashboard/reseps/{{ $resep->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <a href="/dashboard/reseps/{{ $resep->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <form action="/dashboard/reseps/{{ $resep->slug }}" method="POST" class="d-inline">
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
