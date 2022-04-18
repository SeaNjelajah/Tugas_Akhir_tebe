@extends('admin.layout.app')

@section('header')

<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $total_reservasi }}</h3>

                <p>Reservasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-paper"></i>
            </div>
            <a href="{{ route('admin.reservasi.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp. {{ number_format($total_pendapatan) }}</h3>

                <p>Pendapatan Bulan ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.laporanKeuangan.index', ["between" => "month"]) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $total_checkin }}</h3>

                <p>Check In Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.daftarTamu.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $total_terisi }}</h3>

                <p>Kamar Terisi</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.daftarTamu.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">

    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Reservasi Terbaru</h3>

                <div class="card-tools">
                    <a href="{{ route('admin.reservasi.index') }}" class="btn btn-primary">
                        More
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Pembayaran</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banyak_reservasi as $reservasi)
                        <tr>
                            <td>{{ IndonesiaDate ($reservasi->created_at) }}</td>
                            <td>{{ $reservasi->nama_tamu }}</td>
                            <td>{{ $reservasi->pembayaran }}</td>
                            
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-sm-6">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Check In Terbaru</h3>

                <div class="card-tools">
                    <a href="{{ route('admin.daftarTamu.index') }}" class="btn btn-primary">
                        More
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Pembayaran</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banyak_tamu as $tamu)
                        @php
                            $reservasi = $tamu->reservasi;
                        @endphp
                        
                        <tr>
                            <td>{{ IndonesiaDate ($reservasi->created_at) }}</td>
                            <td>{{ $reservasi->nama_tamu }}</td>
                            <td>{{ $reservasi->pembayaran }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </div>

</div>
@endsection