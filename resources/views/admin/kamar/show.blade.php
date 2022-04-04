@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Rincian Kamar</h1>
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
<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gambar Utama</h3>
        
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
        
                <div class="card-body">
        
                    @php
                    $gambar_utama = $kamar->gambar_utama() or false;
                    @endphp
                    
                    @if ($gambar_utama)
                    <img class="img-fluid w-100" src="{{ asset('storage/kamar/' . $gambar_utama->gambar) }}" alt="Gambar Kamar">
                    @else
                    <img class="img-fluid w-100" src="{{ asset('images/NoImage.png') }}" alt="Gambar Kamar">
                    @endif
        
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Gambar</h3>
        
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
        
                <div class="card-body">
        
                    <div id="gambar" class="carousel slide" data-ride="carousel">
                        @php
                            $gambar_kamar = $kamar->gambar()->where('gambar_utama', false)->get();
                            $active = true;
                            $num = 0;
                        @endphp
                        
                        <ol class="carousel-indicators">
                        @foreach ($gambar_kamar as $gambar)
                            <li data-target="#gambar" data-slide-to="{{ $num++ }}" class="{{ ($active) ? 'active' : '' }}"></li>
                        @endforeach
                        </ol>

                        <div class="carousel-inner">
        
                            @php
                            $gambar_kamar = $kamar->gambar()->where('gambar_utama', false)->get();
                            $active = true;
                            @endphp
        
                            @foreach ($gambar_kamar as $gambar)
                            <div class="carousel-item {{ ($active) ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ asset('storage/kamar/' . $gambar->gambar) }}" alt="Slide">
                            </div>
        
                            @php
                            $active = false;
                            @endphp
        
                            @endforeach
        
                        </div>
                        <a class="carousel-control-prev" href="#gambar" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#gambar" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>
        
                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informasi Lainnya</h3>
        
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <h3>{{ $kamar->nama }}</h3>

                    <p class="card-text pl-3">
                        {{ $kamar->deskripsi }}
                    </p>

                    <hr class="my-3">

                    <div class="row text-left">
                        <div class="col">
                            Harga: Rp, {{ number_format($kamar->harga) }}
                        </div>

                        <div class="col">
                            Ukuran: {{ $kamar->ukuran }} m²
                        </div>
                    </div>
                    

                </div>

            </div>
        </div>
    </div>

    <div class="row px-2 my-3">
        <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    
</section>
@endsection