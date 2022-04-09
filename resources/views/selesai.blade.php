<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>BEAN.com | teBEandriAN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">

</head>

<body>

    <div class="wrapper" id="img-out">
        <div class="content p-5">

            <div class="row">
                <div class="col-12">
                    <div class="mx-auto invoice m-0 p-2 px-5 pb-3 w-50" id="widget">
                        <!-- title row -->
                        <div class="row">
    
                            <div class="col-12">
                                <h4>
                                    Tiket Reservasi
                                </h4>
                            </div>
    
                        </div>
    
                        <div class="row invoice-info">
    
                            <div class="invoice-col mx-4 my-3 text-center">
                                {!! QrCode::size(250)->generate($reservasi->qrcode); !!}
                                <br>
                                <h4 class="mt-2 mb-0">{{ $reservasi->qrcode }}</h4>
                            </div>
    
    
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
                            @php
                            $kamar = $reservasi->kamar()->first();
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
                
                
                <div class="col-12">

                    <div class="mx-auto d-flex justify-content-between w-50 px-3 mt-2">
                        <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
                        <div id="btnSave" class="btn btn-danger">Download</div>
                    </div>
                    
                </div>

            </div>

            

            

        </div>
    </div>


    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('assets/html2canvas.min.js') }}"></script>

    <script src="{{ asset('assets/script2.js') }}"></script>
</body>

</html>