@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Riwayat</h1>
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
                    <h3 class="card-title">Tabel Riwayat</h3>
                </div>
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Nama Tamu</th>
                                <th>Check In Pada</th>
                                <th>Check Out Pada</th>
                                <th>Harga</th>
                                <th>Status</th>

                            </tr>
                        </thead>

                        <tbody>
                            @php $num = 0; @endphp

                            @foreach ($banyak_riwayat as $riwayat)

                            @php
                            $reservasi = $riwayat;
                            $check_in = $reservasi->check_in()->first();
                            $check_out = $reservasi->check_out()->first()
                            @endphp


                            <tr data-widget="expandable-table" aria-expanded="false">

                                <td>{{ ++$num }}</td>
                                <td>{{ $reservasi->nama_tamu }}</td>

                                @if (empty($check_in->created_at))
                                <td> - </td>
                                @else
                                <td>{{ $check_in->created_at }}</td>
                                @endif

                                @if (empty($check_out->created_at))
                                <td> - </td>
                                @else
                                <td>{{ $check_out->created_at }}</td>
                                @endif

                                
                                <td>
                                    {{ number_format($reservasi->pembayaran) }}
                                </td>
                                <td>
                                    {{ $reservasi->status }}
                                </td>


                            </tr>

                            <tr class="expandable-body d-none">
                                <td colspan="6">

                                    <div class="card card-primary card-tabs">
                                        <div class="card-header p-0 pt-1">

                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-rincian-tab{{ $reservasi->id }}" data-toggle="pill" href="#custom-tabs-one-rincian{{ $reservasi->id }}" role="tab" aria-controls="custom-tabs-one-rincian{{ $reservasi->id }}" aria-selected="true">Rincian</a>
                                                
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-tiket-reservasi-tab{{ $reservasi->id }}" data-toggle="pill" href="#custom-tabs-one-tiket-reservasi{{ $reservasi->id }}" role="tab" aria-controls="custom-tabs-one-tiket-reservasi{{ $reservasi->id }}" aria-selected="false">Tiket Reservasi</a>
                                                </li>
                                                
                                                

                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                
                                                <div class="tab-pane fade active show" id="custom-tabs-one-rincian{{ $reservasi->id }}" role="tabpanel" aria-labelledby="custom-tabs-one-rincian-tab{{ $reservasi->id }}">


                                                    <div class="row">

                                                        <div class="col-12">

                                                            <div class="row">
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="info-box bg-light">
                                                                        <div class="info-box-content">
                                                                            <span class="info-box-text text-center text-muted">Rencana Check In</span>
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

                                                <div class="tab-pane fade" id="custom-tabs-one-tiket-reservasi{{ $reservasi->id }}" role="tabpanel" aria-labelledby="custom-tabs-one-tiket-reservasi-tab{{ $reservasi->id }}">


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
                                                                        @foreach ($reservasi->kamar()->get() as $item)
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
                                                            

                                                        </div>
                                                        <!-- /.row -->

                                                        <div class="row">
                                                            <!-- accepted payments column -->
                                                            <div class="col-12">

                                                                
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
                                                                

                                                            </div>
                                                            <!-- /.col -->


                                                            


                                                        </div>
                                                        <!-- /.row -->

                                                        

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
                    {{ $banyak_riwayat->links() }}
                </div>
            </div>


        </div>
    </div>


</div>
@endsection