@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Daftar Tamu</h1>
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
<div class="container-fluid">

    <div class="row">
        <div class="col-12">



            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Daftar Tamu</h3>
                </div>
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Nama Tamu</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Kode Kamar</th>
                                <th >Aksi</th>

                            </tr>
                        </thead>

                        <tbody>
                            @php $num = 0; @endphp

                            @foreach ($daftar_tamu as $tamu)

                            @php
                            $reservasi = $tamu;
                            $kode_kamar = $reservasi->kode_kamar()->get();
                            
                            @endphp


                            <tr data-widget="expandable-table" aria-expanded="false">

                                <td>{{ ++$num }}</td>
                                <td>{{ $reservasi->nama_tamu }}</td>
                                <td>{{ $reservasi->check_in }}</td>
                                <td>{{ $reservasi->check_out }}</td>

                                <td>
                                    {{ $kode_kamar->implode('kode_kamar', ',') }}
                                </td>

                                <td class="p-1 text-center">
                                    <a href="{{ route('admin.daftarTamu.checkout', $reservasi->id) }}" class="m-0 btn btn-primary d-inline-block">Check Out</a>
                                </td>


                            </tr>

                            <tr class="expandable-body d-none">
                                <td colspan="6">

                                    <div class="card card-primary card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-rincian-tab" data-toggle="pill" href="#custom-tabs-one-rincian" role="tab" aria-controls="custom-tabs-one-rincian" aria-selected="true">Rincian</a>
                                                
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-tiket-reservasi-tab" data-toggle="pill" href="#custom-tabs-one-tiket-reservasi" role="tab" aria-controls="custom-tabs-one-tiket-reservasi" aria-selected="false">Tiket Reservasi</a>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-kamar-tab" data-toggle="pill" href="#custom-tabs-one-kamar" role="tab" aria-controls="custom-tabs-one-kamar" aria-selected="false">Kamar</a>
                                                </li>

                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                
                                                <div class="tab-pane fade active show" id="custom-tabs-one-rincian" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">


                                                    <div class="row">

                                                        <div class="col-12">

                                                            <div class="row">
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="info-box bg-light">
                                                                        <div class="info-box-content">
                                                                            <span class="info-box-text text-center text-muted">Check In</span>
                                                                            <span class="info-box-number text-center text-muted mb-0">{{ $reservasi->check_in }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-4">
                                                                    <div class="info-box bg-light">
                                                                        <div class="info-box-content"> 
                                                                            <span class="info-box-text text-center text-muted">Durasi</span>
                                                                            <span class="info-box-number text-center text-muted mb-0">{{ $reservasi->durasi }} Malam</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-4">
                                                                    <div class="info-box bg-light">
                                                                        <div class="info-box-content">
                                                                            <span class="info-box-text text-center text-muted">Rencana Check Out</span>
                                                                            <span class="info-box-number text-center text-muted mb-0">{{ $reservasi->check_out }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @php
                                                                $check_in = $reservasi->check_in()->first();
                                                                @endphp

                                                                @if ($check_in)
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="info-box bg-light">
                                                                        <div class="info-box-content">
                                                                            <span class="info-box-text text-center text-muted">Check In Sebenarnya</span>
                                                                            <span class="info-box-number text-center text-muted mb-0">{{ $check_in->created_at }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            </div>

                                                            <div class="row">
                                                                <h4 class="col-12 pb-3 border border-top-0 border-right-0 border-left-0">More Info</h4>

                                                                <div class="col-3">

                                                                    <strong>Nama Tamu:</strong><br>
                                                                    {{ $reservasi->nama_tamu }}

                                                                </div>

                                                                <div class="col-3">

                                                                    <strong>Email:</strong><br>
                                                                    {{ $reservasi->email }}

                                                                </div>

                                                                <div class="col-3">

                                                                    <strong>Nomor Telepon:</strong><br>
                                                                    {{ $reservasi->no_tlp }}

                                                                </div>

                                                                <div class="col-3 mb-2">

                                                                    <strong>Jumlah Kamar:</strong><br>
                                                                    {{ $reservasi->jumlah_k }}

                                                                </div>

                                                                <div class="col-3">

                                                                    <strong>Jumlah Dewasa:</strong><br>
                                                                    {{ $reservasi->jumlah_d }}

                                                                </div>

                                                                <div class="col-3">

                                                                    <strong>Jumlah Anak<sup>2</sup>:</strong><br>
                                                                    {{ $reservasi->jumlah_a }}

                                                                </div>

                                                                <div class="col-3 mb-2">

                                                                    <strong>Pembayaran:</strong><br>
                                                                    Rp.{{ number_format ($reservasi->pembayaran) }}

                                                                </div>

                                                                <div class="col-12 ">

                                                                    <strong>Pesan Lainnya:</strong><br>
                                                                    {{ $reservasi->pesan_lain }}

                                                                </div>




                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="custom-tabs-one-tiket-reservasi" role="tabpanel" aria-labelledby="custom-tabs-one-tiket-reservasi-tab">


                                                    <div class="invoice m-0 p-2 px-5 pb-3">
                                                        <!-- title row -->
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <h4>
                                                                    Tiket Reservasi
                                                                </h4>
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- info row -->
                                                        <div class="row invoice-info">

                                                            <div class="invoice-col mx-4 my-3 text-center">
                                                                {!! QrCode::size(250)->generate($reservasi->qrcode); !!}
                                                                <br>
                                                                <h4 class="mt-2 mb-0">{{ $reservasi->qrcode }}</h4>
                                                            </div>
                                                            <!-- /.col -->

                                                            <div class="invoice-col col">
                                                                <address>
                                                                    <strong>{{ $reservasi->nama_tamu }}</strong><br>
                                                                    Phone: {{ $reservasi->no_tlp }}<br>
                                                                    Email: {{ $reservasi->email }}
                                                                </address>

                                                                <b>Reservasi ID:</b> {{ $reservasi->id }}<br>
                                                                <b>Created At:</b> {{ $reservasi->created_at }}<br>
                                                                <br>
                                                                <b>Rencana Check In:</b> {{ $reservasi->check_in }}<br>
                                                                <b>Rencana Check Out:</b> {{ $reservasi->check_out }}<br>
                                                            </div>

                                                            <div class="invoice-col col">
                                                                <b>Pesan Lain:</b><br>
                                                                {{ $reservasi->pesan_lain }}
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->

                                                        <!-- Table row -->
                                                        <div class="row">
                                                            @php
                                                            $kamar = $reservasi->kamar()->exists();
                                                            @endphp

                                                            @if ($kamar)
                                                            <div class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Kamar</th>
                                                                            <th>Jumlah</th>
                                                                            <th>Deskripsi</th>
                                                                            <th>Subtotal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php $num_2 = 0; @endphp
                                                                        @foreach ($reservasi->kamar as $item)
                                                                        <tr>
                                                                            <td>{{ ++$num_2 }}</td>
                                                                            <td>{{ $item->nama }}</td>
                                                                            <td>{{ $item->pivot->jumlah_kamar }}</td>
                                                                            <td>{{ $item->deskripsi }}</td>
                                                                            <td>Rp, {{ number_format($item->pivot->subtotal) }}</td>
                                                                        </tr>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @else
                                                            <div class="col-12 table-responsive">
                                                                <table class="table table-striped border">
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th colspan="5">Belum Memilih Kamar</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <tr>
                                                                            <td>
                                                                                <a href="{{ route('admin.reservasi.edit', $reservasi->id) }}" class="btn btn-primary btn-block">
                                                                                    <i class="fas fa-search mr-1"></i> Pilih Kamar
                                                                                </a>
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @endif


                                                        </div>
                                                        <!-- /.row -->

                                                        <div class="row">
                                                            <!-- accepted payments column -->
                                                            <div class="col-12">

                                                                @if ($kamar)
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Total:</th>
                                                                                <td>Rp.{{ number_format($reservasi->pembayaran) }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                @endif

                                                            </div>
                                                            <!-- /.col -->


                                                            


                                                        </div>
                                                        <!-- /.row -->

                                                        

                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="custom-tabs-one-kamar" role="tabpanel" aria-labelledby="custom-tabs-one-profile-kamar">
                                                    <div class="col-12 px-3 mt-4 ">
                                                        @if ($kamar)
                                                        @foreach ($reservasi->kamar as $item)

                                                        <div class="card card-secondary mx-auto">
                                                            <div class="card-header">
                                                                <h3 class="card-title">{{ $item->nama }}</h3>

                                                                <div class="card-tools">

                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">

                                                                <div class="row">



                                                                    <div class="col-12">
                                                                        @php
                                                                        $kode_kamar = $reservasi->kode_kamar()->get();
                                                                        @endphp

                                                                        @for ($i = 0; $i < $kode_kamar->count(); $i++)
                                                                        <div class="form-group" id="kode_kamar_template">
                                                                            <label>Kamar {{ $i + 1 }}</label>

                                                                            <div class="form-control">{{ $kode_kamar->get($i)->kode_kamar }}</div>

                                                                        </div>
                                                                        @endfor
                                                                        


                                                                    </div>
                                                                    <!-- /.col -->
                                                                </div>
                                                                <!-- /.row -->
                                                            </div>

                                                            <div class="card-footer text-right">
                                                                {{ $item->pivot->jumlah_kamar }} Kamar Terpilih
                                                            </div>


                                                        </div>
                                                        @endforeach
                                                        @endif

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </td>
                            </tr>


                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $daftar_tamu->links() }}
                </div>
            </div>


        </div>
    </div>


</div>
@endsection