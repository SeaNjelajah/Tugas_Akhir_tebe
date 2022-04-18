@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Contact Message</h1>
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
<dib class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($contact_message as $contact)

                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>{{ $contact->id }}</td>  
                                <td>{{ $contact->created_at }}</td>  
                                <td>{{ $contact->nama }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                            </tr>


                            <tr class="expandable-body d-none">
                                <td colspan="5">
                                    <div>
                                        <h4>Pesan</h4>
                                        <p style="white-space: pre-line">{{ $contact->pesan }}</p>
                                    </div>
                                    
                                </td>
                            </tr>

                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $contact_message->links('vendor.pagination.default') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</dib>
@endsection