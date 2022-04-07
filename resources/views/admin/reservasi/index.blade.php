@extends('admin.layout.app')

@section('header')
<div class="container-fluid">
    
    <div class="row mb-2 ">

        <div class="col-sm-3">
            <h1 class="m-0">Reservasi</h1>
        </div>

        <div class="col-sm-9 ml-auto d-inline-block text-right">

            <form action="#" class="d-inline-flex ml-auto" method="GET">

                <input type="text" name="search" class="form-control w-50" placeholder="Qr Code">

                <button class="btn btn-primary d-inline-block ml-1">
                    <i class="fas fa-search mr-1"></i> Cari Dengan Kode
                </button>

            </form>

            <a href="{{ route('admin.reservasi.create') }}" class="btn btn-primary position-relative" style="bottom: 2px;">
                Buat Reservasi
            </a>

        </div>

        {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Rese</li>
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
                <h3 class="card-title">Tabel Reservasi</h3>
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
                            <th>ID Kamar</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $num = 0; @endphp

                        @foreach ($banyak_reservasi as $reservasi)

                        @php
                        $kamar = $reservasi->kamar()->first() or false;
                        @endphp
                        
                        <tr data-widget="expandable-table" aria-expanded="false">

                            <td>{{ ++$num }}</td>
                            <td>{{ $reservasi->nama_tamu }}</td>
                            <td>{{ $reservasi->check_in }}</td>
                            <td>{{ $reservasi->check_out }}</td>
                            <td>@if ($kamar) Sudah di pilih @else Belum di pilih @endif</td>
                            <td>{{ $reservasi->status }}</td>

                        </tr>

                        <tr class="expandable-body d-none">
                            <td colspan="6">

                                <div class="card m-0 d-flex w-100 justify-content-center">

                                    

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
                                                    <b>Check In:</b> {{ $reservasi->check_in }}<br>
                                                    <b>Check Out:</b> {{ $reservasi->check_out }}<br>
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
                                                            <tr>
                                                                <td>{{ ++$num_2 }}</td>
                                                                <td>Call of Duty</td>
                                                                <td>455-981-221</td>
                                                                <td>El snort testosterone trophy driving gloves handsome</td>
                                                                <td>$64.50</td>
                                                            </tr>
                                                            
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
                                                                    <a href="#" class="btn btn-primary btn-block">
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
                                                                    <th style="width:50%">Subtotal:</th>
                                                                    <td>$250.30</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tax (9.3%)</th>
                                                                    <td>$10.34</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Shipping:</th>
                                                                    <td>$5.80</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total:</th>
                                                                    <td>$265.24</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif

                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">


                                                <div class="col-12 my-2">

                                                    <button type="button" class="btn btn-success float-right">
                                                        <i class="fas fa-money-bill mr-1"></i>Check In and Payment
                                                    </button>
                                                    
                                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                        <i class="fas fa-credit-card"></i> Payment
                                                    </button>

                                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                        <i class="fas fa-check"></i> Check In
                                                    </button>

                                                    


                                                </div>

                                                
                                            </div>
                                    </div>

                                    

                                    <div class="card-footer">
                                        <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="btn btn-primary">Rincian</a>
                                        <a href="{{ route('admin.reservasi.edit', $reservasi->id) }}" class="btn btn-warning">Edit</a>
                                        <a data-toggle="modal" data-target="#modal_delete{{ $reservasi->id }}" href="#" class="float-right btn btn-danger">Hapus</a>
                                    </div>


                                </div>

                            </td>
                        </tr>


                        {{-- delete Modal --}}
                        <form action="{{ route('admin.reservasi.destroy', $reservasi->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal fade" id="modal_delete{{ $reservasi->id }}" aria-modal="true" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Data?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body text-center">
                                            <div class="row d-flex justify-content-center">
                                                <i class="fas fa-info" style="font-size: 60px"></i>
                                            </div>
                                            <label class="mt-3">Anda yakin anda tidak bisa mengembalikannya lagi?</label>
                                        </div>

                                        <div class="modal-footer row p-0 m-0 pr-3 pl-1">

                                            <div class="col-auto m-0 p-0 ml-auto">
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </form>

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