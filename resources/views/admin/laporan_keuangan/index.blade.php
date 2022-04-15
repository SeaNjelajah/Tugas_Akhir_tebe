@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm">
            <h1 class="m-0">Laporan Keuangan</h1>
        </div>

        <div class="col-sm-auto">
            @php
            
            $between = Request::get('between');

            if (empty($between)) {
                $between = "week";
            }

            @endphp
            <div class="card d-inline-block px-3 py-2">

                <a class="btn @if ($between == "week") btn-primary @else btn-outline-primary @endif" href="{{ route('admin.laporanKeuangan.index', ["between" => "week"]) }}">Minggu Ini</a>
                <a class="btn @if ($between == "month") btn-primary @else btn-outline-primary @endif" href="{{ route('admin.laporanKeuangan.index', ["between" => "month"]) }}">Bulan Ini</a>
                <a class="btn @if ($between == "year") btn-primary @else btn-outline-primary @endif" href="{{ route('admin.laporanKeuangan.index', ["between" => "year"]) }}">Tahun Ini</a>
                <a class="btn @if ($between == "all") btn-primary @else btn-outline-primary @endif" href="{{ route('admin.laporanKeuangan.index', ["between" => "all"]) }}">Semua</a>

            </div>
        
        </div>

        <div class="col-sm-auto">

            <div class="card border-primary border d-inline-block px-3 py-2">
                <h4 class="card-title text-primary">Pendapatan: </h4>

                <div class="card-body p-1">
                    <p class="card-text h3 text-primary">
                        Rp. {{ number_format ($total) }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
    
                <div class="card-body">
                    <table id="table" class="table dataTable">
                        <thead>
    
                            <tr>
                                <th>Id</th>
                                <th>Check Out</th>
                                <th>Harga Total</th>
                            </tr>
    
                        </thead>
                        <tbody>
                            @foreach ($banyak_laporan as $laporan)
                            @php
                                $check_out = $laporan->check_out()->first();

                            @endphp
                            
                            <tr>
                                <td>{{ $laporan->id }}</td>
                                <td>{{ $check_out->created_at }}</td>
                                <td>Rp. {{ number_format ($laporan->pembayaran) }}</td>
                            </tr>
                            @endforeach
    
                        </tbody>
                        
                    </table>
    
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
</div>
@endsection


@section('style')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection


@section('script')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
    setTimeout(() => {


        
  $(function () {
      
    $("#table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');

    
  });



    }, 600);
</script>
@endsection