@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Fasilitas Kamar</h1>
        </div>


        

    </div>

</div>
@endsection

@section('content')
<div class="container-fluid">

    {{-- Create Fasilitas Modal --}}
    <div class="modal fade" id="create-Fasilitas-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered bg-transparent border-0">
            <div class="modal-content p-4">
                <form action="{{ route('admin.fasilitas.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <div class="input-group">

                            <input class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" type="text" name="fasilitas"  placeholder="*" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary">Create</button>
                            </div>

                        </div>

                        @error('fasilitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div> 
                        @enderror
                        
                    </div>
                </form>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Fasilitas</h3>
                        </div>

                        <div class="col-auto">
                            <a class="btn btn-primary active" data-toggle="modal" data-target="#create-Fasilitas-modal">Create</a>
                        </div>
                    </div>
                    

                    

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Fasiltas Kamar</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $banyak_fasilitas->count(); $i++)

                            @php $fasilitas = $banyak_fasilitas->get($i); @endphp
                            <tr>
                                <td>{{ 1 + $i }}.</td>
                                <td>{{ $fasilitas->fasilitas }}</td>
                                <td class="d-flex">

                                    <a class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#edit-model{{ $fasilitas->id }}">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    

                                    <a token="{{ csrf_token() }}" method="DELETE" set="sweet-alert-delete" url="{{ route('admin.fasilitas.destroy', $fasilitas->id) }}" class="ml-1 active btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="edit-model{{ $fasilitas->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered bg-transparent border-0">
                                    <div class="modal-content p-4">
                                        <form action="{{ route('admin.fasilitas.update', $fasilitas->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="fasilitas{{$fasilitas->id}}">Fasilitas</label>
                                                <div class="input-group">
    
                                                    <input class="form-control @error('fasilitas' . $fasilitas->id) is-invalid @enderror" id="fasilitas{{$fasilitas->id}}" type="text" name="fasilitas{{$fasilitas->id}}"  placeholder="{{ $fasilitas->fasilitas }}" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary">Save</button>
                                                    </div>
    
                                                </div>
    
                                                @error('fasilitas' . $fasilitas->id)
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div> 
                                                @enderror
                                                
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>

                            @endfor

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $banyak_fasilitas->links('vendor.pagination.default') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>
@endsection