@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2 ">

        <div class="col-sm-3">
            <h1 class="m-0">Reservasi</h1>
        </div>

        <div class="col-sm-9 ml-auto d-inline-block text-right">

            <form class="d-inline-flex ml-auto" method="GET">

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
                            <th>Kamar</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @php $num = 0; @endphp

                        @foreach ($banyak_reservasi as $reservasi)

                        @php
                        $kamar = $reservasi->kamar->first();
                        @endphp


                        <tr data-widget="expandable-table" aria-expanded="false">

                            <td>{{ ++$num }}</td>
                            <td>{{ $reservasi->nama_tamu }}</td>
                            <td>{{ $reservasi->check_in }}</td>
                            <td>{{ $reservasi->check_out }}</td>
                            <td>
                                @if ($kamar)
                                Sudah di pilih
                                @else
                                Belum di pilih
                                @endif
                            </td>
                            

                        </tr>

                        <tr class="expandable-body d-none">
                            <td colspan="5">

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

                                            <div class="col-12 px-3 mt-4 ">
                                                @if ($kamar)
                                                <form action="{{ route('admin.reservasi.simpan.kode.kamar', $reservasi->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    
                                                    
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
                                                                    @error("pilih_kode_kamar.$item->id.*")
                                                                    <div class="alert alert-danger alert-dismissible show" role="alert">
                                                                        {{ $message }}
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                      </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-12">
                                                                    @php
                                                                        $kode_kamar_id = $item->kode_kamar()->pluck('id');
                                                                        $terisi = $reservasi->kode_kamar()->where('terisi', true)->pluck('id');
                                                                    @endphp

                                                                    @if ($reservasi->kode_kamar()->first())
                                                                        @php $p = 1; @endphp
                                                                        @foreach ($reservasi->kode_kamar as $kode_k1)

                                                                            @if ($item->kode_kamar()->find( $kode_k1->id))
                                                                            <div class="form-group" id="kode_kamar_template">
                                                                                <label for="pilih_kode_kamar{{ $p }}">Kamar {{ $p }}</label>

                                                                                <select name="pilih_kode_kamar[{{ $item->id }}][]" class="form-control" id="pilih_kode_kamar{{ $p }}">

                                                                                    <option selected value="{{ $kode_k1->id }}">{{ $kode_k1->kode_kamar }}</option>

                                                                                    @foreach ($item->kode_kamar()->where('terisi', false)->get() as $kode_k2)
                                                                                    @if ($kode_k2->id == $kode_k1->id)
                                                                                        @continue
                                                                                    @endif
                                                                                    <option value="{{ $kode_k2->id }}">{{ $kode_k2->kode_kamar }}</option>
                                                                                    @endforeach

                                                                                </select>

                                                                            </div>
                                                                            @endif
                                                                        @php $p += 1; @endphp
                                                                        @endforeach
                                                                    @else

                                                                    
                                                                    @for ($p = 1; $p <= $item->pivot->jumlah_kamar; $p++)

                                                                        <div class="form-group" id="kode_kamar_template">
                                                                            <label for="pilih_kode_kamar{{ $p }}">Kamar {{ $p }}</label>

                                                                            <select name="pilih_kode_kamar[{{ $item->id }}][]" class="form-control" id="pilih_kode_kamar{{ $p }}">

                                                                                <option value="">None</option>

                                                                                @foreach ($item->kode_kamar()->where('terisi', false)->get() as $kode_kamar)
                                                                                <option value="{{ $kode_kamar->id }}">{{ $kode_kamar->kode_kamar }}</option>
                                                                                @endforeach

                                                                            </select>

                                                                        </div>
                                                                    
                                                                    @endfor

                                                                    @endif
                                                                    

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

                                                    @if ($reservasi->kode_kamar()->first())
                                                    <button href="{{ route('admin.reservasi.simpan.kode.kamar', $reservasi->id) }}" class="btn btn-outline-primary float-right" style="margin-right: 5px;">
                                                        <i class="fas fa-check"></i> Simpan Kode Kamar Lagi
                                                    </button>
                                                    @else
                                                    <button href="{{ route('admin.reservasi.simpan.kode.kamar', $reservasi->id) }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                        <i class="fas fa-bed"></i> Pilih Kode Kamar
                                                    </button>
                                                    @endif


                                                </form>

                                                @endif


                                            </div>

                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">


                                            <div class="col-12 my-2">



                                                @php
                                                $pembayaran = $reservasi->pembayaran()->first();
                                                @endphp

                                                @if (!($pembayaran || $reservasi->status == "Check In"))
                                                <a href="{{ route('admin.reservasi.check.in.payment', $reservasi->id) }}" type="button" class="btn btn-success float-right">
                                                    <i class="fas fa-money-bill mr-1"></i>Check In and Payment
                                                </a>
                                                @endif

                                                @if ($pembayaran)
                                                <button type="button" class="btn btn-outline-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-check"></i> Payment
                                                </button>
                                                @else
                                                <a href="{{ route('admin.reservasi.payment', $reservasi->id) }}" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-credit-card"></i> Payment
                                                </a>
                                                @endif

                                                @if ($reservasi->status == "Check In")
                                                <button type="button" class="btn btn-outline-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-check"></i> Check In
                                                </button>
                                                @else
                                                <a href="{{ route('admin.reservasi.check.in', $reservasi->id) }}" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-clock"></i> Check In
                                                </a>
                                                @endif





                                            </div>


                                        </div>
                                    </div>



                                    <div class="card-footer">
                                        <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="btn btn-primary">Rincian</a>
                                        <a href="{{ route('admin.reservasi.edit', $reservasi->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.reservasi.batalkan', $reservasi->id) }}" class="active float-right btn btn-danger">Batalkan</a>
                                    </div>


                                </div>

                            </td>
                        </tr>


                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $banyak_reservasi->links('vendor.pagination.default') }}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection