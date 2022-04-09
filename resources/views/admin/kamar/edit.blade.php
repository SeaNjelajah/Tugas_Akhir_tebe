@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Edit Kamar</h1>
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
<form id="form1" method="POST" action="{{ route('admin.kamar.update', $kamar->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="file" name="gambar[]" id="MergeFile" class="d-none">

    <section class="content">

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $error }}</strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

        </div>
        @endforeach

        <div class="row">

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kamar</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Kamar</label>
                            <input name="nama" type="text" value="{{ $kamar->nama }}" id="nama" class="form-control">

                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror


                        </div>


                        <div class="form-group">
                            <label for="deskripsi">Dekripsi Kamar</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ $kamar->deskripsi }}</textarea>

                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="status" id="status" class="form-control custom-select">
                                @php $status = $kamar->status; @endphp 
                                <option @if ($status == "Tersedia") selected @endif>Tersedia</option>
                                <option @if ($status == "Penuh") selected @endif>Penuh</option>
                                <option @if ($status == "Tidak Tersedia") selected @endif>Tidak Tersedia</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="ukuran">Ukuran</label>

                            <div class="input-group">
                                

                                <input name="ukuran" value="{{ $kamar->ukuran }}" type="number" name="ukuran" class="form-control">
                                
                                <div class="input-group-append">
                                    <span class="input-group-text">m²</span>
                                </div>

                                @error('ukuran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            


                        </div>

                        <div class="form-group">

                            <label for="harga">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input name="harga" value="{{ $kamar->harga }}" type="number" name="harga" class="form-control">

                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            


                        </div>

                        <div class="form-group">
                            <label for="jumlah_kamar">Jumlah Kamar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input min="0" name="jumlah_kamar" value="{{ $kamar->jumlah_kamar }}" type="number" name="jumlah_kamar" class="form-control @error('jumlah_kamar') is-invalid @enderror">

                                @error('jumlah_kamar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            


                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Fasilitas</h3>

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
                                <div class="form-group">
                                    <select name="fasilitas[]" class="duallistbox" multiple>
                                        
                                        @php
                                        $selected = $kamar->fasilitas()->pluck('fasilitas');
                                        @endphp

                                        @foreach ($tbl_fasilitas as $fasilitas)
                                        <option @foreach ($selected as $c) @if($c == $fasilitas->fasilitas) selected @endif @endforeach value="{{ $fasilitas->id }}">{{ $fasilitas->fasilitas }}</option>
                                        @endforeach

                                            
                                        

                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        Fasilitas yang ada dalam kamar!
                    </div>

                </div>

                <div class="card">

                    @php
                    $gambar_utama = $kamar->gambar_utama() or false;
                    @endphp

                    @if ($gambar_utama)
                    <img id="preview" class="card-img-top" src="{{ asset('storage/kamar/' . $gambar_utama->gambar) }}">
                    @else
                    <img id="preview" class="card-img-top" src="{{ asset('images/NoImage.png') }}">
                    @endif

                    <div class="card-body">
                       
                        <input id="previewUtama" name="gambar_utama" set="preview" to="#preview" type="file" class="form-control" >
                        
                        <small>Gambar Utama</small>

                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h4 class="card-title align-middle">Gallery Kamar</h4>

                        <div class="card-tools">

                            <input id="gambar" type="file" class="form-control" multiple>

                        </div>



                    </div>
                    <div class="card-body">

                        <div class="row gap-3" id="gallery-row">

                            @php $num = 0; @endphp
                            @foreach ($kamar->gambar as $gambar)
                                
                            
                            <div class="col-sm-2 mx-2 border">
                                <a data-toggle="modal" data-target="#gallery{{ $num }}">
                                    <img src="{{ asset('storage/kamar/' . $gambar->gambar) }}" class="img-fluid mb-2 w-100" alt="Gallery Image">
                                </a>
                        
                                <div class="ribbon-wrapper">
                                    <button type="button" set="delete" gambar_id="{{ $gambar->id }}" class="ribbon bg-danger">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        
                            <div class="modal fade" id="gallery{{ $num++ }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" data-dismiss="modal" aria-label="Close">
                                    <div class="modal-content bg-transparent d-flex justify-content-center border-0" style="box-shadow: 0 0 0 0;">
                                        <img src="{{ asset('storage/kamar/' . $gambar->gambar) }}" class="img-fluid mb-2" alt="Gallery Image">
                                    </div>
                                </div>
                            </div>

                            @endforeach


                            

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row mb-4 pb-3">

            <div class="col-12">
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Cancel</a>

                

                <input type="submit" value="Update Kamar" class="btn btn-success float-right">
            </div>

            <div class="col-12 text-center">
                <input type="checkbox" name="delete_image_data" id="delete_image_data">
                <label for="delete_image_data">Jika di centang maka gambar yang terpilih dihapus akan juga dihapus pada penyimpanan</label>
            </div>

        </div>

    </section>
</form>

<div class="d-none">

    <div class="col-sm-2 mx-2 border d-none" id="ColTemplate">
        <a data-toggle="modal" data-target="#gallery1">
            <img src="" class="img-fluid mb-2 w-100" alt="Gallery Image">
        </a>

        <div class="ribbon-wrapper">
            <button set="delete" type="button" class="ribbon bg-danger">
                Hapus
            </button>
        </div>
    </div>

    <div class="modal fade d-none" id="modalTemplate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" data-dismiss="modal" aria-label="Close">
            <div class="modal-content bg-transparent d-flex justify-content-center border-0" style="box-shadow: 0 0 0 0;">
                <img src="" class="img-fluid mb-2" alt="Gallery Image">
            </div>
        </div>
    </div>

</div>

@endsection

@section('style')


{{-- bootstrap duallistbox Style --}}
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

{{-- Gallery Style
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}"> --}}

@endsection

@section('script')

{{-- bootstrap duallistbox Script--}}
<script src="{{ asset('assets/admin/plugins/popper/esm/popper.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery/jquery.slim.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

{{-- Gallery script
<script src="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script> --}}

<script>
    $(() => {
        $('.duallistbox').bootstrapDualListbox();
       
    });

    const mergeFileElement = document.getElementById("MergeFile");

    const mergeFile = [];

    const button_delete = () => {$('button[set=delete]').on('click', function(e) {
        source = e.target;
        
        const target = document.getElementById('gallery-row');
        

        col_gallery = source.parentElement.parentElement;


        if (source.getAttribute('gambar_id')) {

            input = document.createElement("input");
            input.type = "hidden";
            input.name = "delete_image[]";
            input.value = source.getAttribute('gambar_id');

            targetAppend = document.getElementById("form1");
            targetAppend.appendChild(input);

           

        } else {

            nama_gambar = col_gallery.getAttribute("nama_gambar");
           

            for (let i = 0; i < mergeFile.length; i++) {
                if (mergeFile[i].name === nama_gambar) {
                    mergeFile.splice(i, 1);
                    break;
                }
            }

            mergeFileElement.files = createFileList(mergeFile);

        }

        col_gallery.nextElementSibling.remove();
        col_gallery.remove();

    
        

    });}

    const createFileList = (files) => {

        const fileList = new DataTransfer();

        for (let c = 0; c < files.length; c++) {
            fileList.items.add(files[c]);
        }
        // DataTransfer files property is FileList object
        return fileList.files;
    }

    


    $("#gambar").change(function (e) {
        const fileInput = document.getElementById('gambar');
        if (fileInput.files.length <= 0) return;

        files = fileInput.files;

        

        const target = document.getElementById('gallery-row');

        const modalTemplate = document.getElementById('modalTemplate').cloneNode(true);
        
        const gallery_col_Template = document.getElementById('ColTemplate').cloneNode(true);

        for (let i = 0; i < files.length; i++) {

            //add file in merge files array
            for (let a = 0; a < files.length; a++) {

                for (var b = 0; b < mergeFile.length; b++) {
                    if (mergeFile[b].name == files.item(a).name) break;
                }

                if (!(b < mergeFile.length)) mergeFile.push(files.item(a));
                
            }

            // console.log(mergeFile);

            modal = modalTemplate.cloneNode(true);
            gallery_col = gallery_col_Template.cloneNode(true);

            modal.classList.remove("d-none");
            gallery_col.classList.remove("d-none");

            gallery_col.setAttribute("nama_gambar", files.item(i).name);

            modal.id = "gallery" + (target.childElementCount / 2);

            modal_image = modal.querySelector("div > div > div > img");
            modal_image.src = URL.createObjectURL(files[i]);
            
            gallery_col_button = gallery_col.querySelector("a");
            gallery_col_image = gallery_col.querySelector("a > img");

            gallery_col_button.setAttribute('data-target', "#" + modal.id);
            gallery_col_image.src = modal_image.src;
            

            target.appendChild(gallery_col);
            target.appendChild(modal);

        }

        // assign mergeFile contain to hidden input files
        mergeFileElement.files = createFileList(mergeFile);
        button_delete();
    });

    $('input[set=preview]').change(function (e) {
        target = document.querySelector(e.target.getAttribute('to'));
        target.src = URL.createObjectURL(e.target.files[0]);
    });

    


    
    //Reinit if input has some data
    setTimeout(() => {
            if (document.getElementById('gambar').files[0]) {
                $("#gambar").change();
            }
            
            if (document.getElementById('previewUtama').files[0]) {
                $('input[set=preview]').change();
            }

            button_delete();

    }, 900);


</script>

@endsection