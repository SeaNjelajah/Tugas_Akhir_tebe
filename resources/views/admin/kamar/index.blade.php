@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Kamar</h1>
        </div>

        <div class="col-sm-6 text-right">
          <a class="btn btn-primary" href="{{ route('admin.kamar.create') }}">Tambah</a>
        </div>

        {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div> --}}

    </div>
    
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Kamar</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Kamar</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>

         
              @foreach ($banyak_kamar as $kamar)
              @php
              $gambar_utama = $kamar->gambar_utama() or false;
              @endphp
              <tr data-widget="expandable-table" aria-expanded="false">
                <td>{{ $kamar->id }}</td>
                <td>{{ $kamar->nama }}</td>
                <td>{{ $kamar->ukuran }} m²</td>
                <td>Rp, {{ number_format($kamar->harga) }}</td>
                <td>{{ $kamar->status }}</td>
              </tr>

              <tr class="expandable-body d-none">
                <td colspan="5">
                  
                  <div class="card m-0">
                    <div class="row">

                      <div class="col-4">
                        @if ($gambar_utama)
                        <img class="img-fluid w-100" src="{{ asset('storage/kamar/' . $gambar_utama->gambar) }}" alt="Gambar Kamar">
                        @else
                        <img class="img-fluid w-100" src="{{ asset('images/NoImage.png') }}" alt="Gambar Kamar">
                        @endif

                      </div>
  
                      <div class="col">
                        <div class="row h-100">

                          <div class="col-12 h-75">
                            <p>
                              {{ $kamar->deskripsi }}
                            </p>
                          </div>

                          <div class="col-12">

                            <div class="float-right pl-3">
                              <strong>Kamar Tersisa:</strong>
                              {{ $kamar->jumlah_kamar }}
                            </div>

                          </div>

                        </div>
                        
                      </div>

                    </div>

                    <div class="card-footer">
                      <a href="{{ route('admin.kamar.show', $kamar->id) }}" class="btn btn-primary">Rincian</a>
                      <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="btn btn-warning">Edit</a>
                      <a token="{{ csrf_token() }}" method="DELETE" set="sweet-alert-delete" url="{{ route('admin.kamar.destroy', $kamar->id) }}" class="active float-right btn btn-danger">Hapus</a>
                    </div>
                   

                  </div>
                  
                </td>
              </tr>


              @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>


@endsection