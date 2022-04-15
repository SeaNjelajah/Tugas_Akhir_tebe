@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2 ">

        <div class="col-sm">
            <h1 class="m-0">Gallery</h1>
        </div>

        <div class="card col-auto px-3 py-2">
            <div class="row">
                <div class="col text-right">
                    <form action="{{ route('admin.gallery.save') }}" id="form_target" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <input checked type="checkbox" name="delete_data_image" id="delete_data_image">
                        <label for="delete_data_image">Hapus Juga data di penyimpanan</label>
                        
                        
                        <button id="save_gallery" class="ml-2 btn btn-primary"><i class="fa fa-save mr-2"></i>Save</button>
                    
                    </form>
                </div>
        
                <div class="col-auto">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-primary">
                        <i class="fas fa-history"></i>
                    </a>
                </div>
            </div>
            

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
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card p-3 d-inline-block">

                <div class="form-group">
                    <label for="tambah_gallery">Tambah Gallery</label>
                    <div class="input-group">
                        <input id="tambah_gallery" type="text" class="form-control" placeholder="Gallery">

                        <div class="input-group-append">
                            <a id="tambah_gallery_button" class="btn btn-primary">
                                Tambah
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row" id="gallery_row">
        
        @foreach ($gallery_list as $list)
        <div class="col-12">

            <div class="card card-primary collapsed-card">

                <div class="card-header">

                    <div class="row">

                        <div class="col-auto">

                            <h4 class="card-title align-middle">{{ $list }}</h4>

                        </div>

                        <div class="col text-right d-inline-block">
                            <input id="add_image" type="file" multiple gallery="{{ $list }}">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                            <a id="Hapus_gallery" set="Hapus_gallery" class="btn btn-danger text-white">
                                Hapus Gallery
                            </a>
                        </div>


                    </div>



                </div>
                <div class="card-body">

                    <div class="row gap-3 row-cols-3" id="gallery_{{ $list }}">

                        @php $i = 0; @endphp
                        @foreach ($gallery_image as $image)
                        
                        @if ($image->gallery == $list)
                        <div class="col-sm-2 col-md-4 border">

                            <a data-toggle="modal" data-target="#gallery_{{ $image->gallery . $i }}">
                                <img src="{{ asset('storage/gallery/' . $image->gambar) }}" class="img-fluid mb-2 w-100" alt="Gallery Image">
                            </a>
                
                            <div class="ribbon-wrapper">
                                <button gambar_id="{{ $image->id }}" type="button" set="delete" class="ribbon bg-danger">
                                    Hapus
                                </button>
                            </div>

                        </div>
                
                        <div class="modal fade" aria-hidden="true" id="gallery_{{ $image->gallery . $i }}">
                            <div class="modal-dialog modal-dialog-centered modal-xl" data-dismiss="modal" aria-label="Close">
                                <div class="modal-content bg-transparent d-flex justify-content-center border-0" style="box-shadow: 0 0 0 0;">
                                    <img src="{{ asset('storage/gallery/' . $image->gambar) }}" class="img-fluid mb-2" alt="Gallery Image">
                                </div>
                            </div>
                        </div>
                        @php $i += 1; @endphp
                        @endif

                        @endforeach


                    </div>


                </div>
            </div>
        </div>
        @endforeach
        


    </div>

    <div class="d-none">

        <div class="col-12" id="gallery_template">

            <div class="card card-primary collapsed-card">

                <div class="card-header">

                    <div class="row">

                        <div class="col-auto">

                            <h4 class="card-title align-middle">Title</h4>

                        </div>

                        <div class="col text-right d-inline-block">
                            <input type="file" multiple >

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                            <a id="Hapus_gallery" set="Hapus_gallery" class="btn btn-danger text-white">
                                Hapus Gallery
                            </a>
                        </div>


                    </div>



                </div>
                <div class="card-body">

                    <div class="row">




                    </div>


                </div>
            </div>
        </div>




        <div class="col-sm-2 col-md-4 border" id="gallery_image_template">
            <a data-toggle="modal" data-target="">
                <img src="" class="img-fluid mb-2 w-100" alt="Gallery Image">
            </a>

            <div class="ribbon-wrapper">
                <button type="button" set="delete" class="ribbon bg-danger">
                    Hapus
                </button>
            </div>
        </div>

        <div class="modal fade" aria-hidden="true" id="gallery_modal_template">
            <div class="modal-dialog modal-dialog-centered modal-xl" data-dismiss="modal" aria-label="Close">
                <div class="modal-content bg-transparent d-flex justify-content-center border-0" style="box-shadow: 0 0 0 0;">
                    <img src="" class="img-fluid mb-2" alt="Gallery Image">
                </div>
            </div>
        </div>


    </div>


</div>
@endsection

@section('style')
    
@endsection

@section('script')
<script src="{{ asset('assets/admin/gallery/script.js') }}"></script>
@endsection