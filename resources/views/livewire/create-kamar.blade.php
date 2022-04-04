<!-- Main content -->
<form wire:submit.prevent="submit">
    <section class="content">
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
                            <input name="nama" type="text" id="nama" class="form-control">

                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror


                        </div>


                        <div class="form-group">
                            <label for="deskripsi">Dekripsi Kamar</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>

                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="status" id="status" class="form-control custom-select">
                                <option>Tersedia</option>
                                <option>Penuh</option>
                                <option>Tidak Tersedia</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="harga" class="form-control">
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
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
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
                <!-- /.card -->
            </div>

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h4 class="card-title my-auto">Gallery Kamar</h4>

                        <div class="card-tools row">

                            <div class="form-group my-auto">

                                <div class="input-group">

                                    <div class="custom-file">
                                        <input id="gambar" wire:model="gambars"  type="file" class="custom-file-input" multiple>
                                        <label class="custom-file-label" for="gambar">{{ count($gambars) }} file Choose</label>
                                    </div>

                                    <div class="input-group-append">
                                        <a class="input-group-text" wire:click="render()">Upload</a>
                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>
                    <div class="card-body">

                        <div class="row" id="gallery-row">
                            @php $k = 1; @endphp
                            @foreach ($gambars as $gambar)

                            <div class="col-sm-2 border">
                                <a data-toggle="modal" data-target="#gallery{{ $k }}">
                                    <img src="" class="img-fluid mb-2 w-100" alt="Gallery Image">
                                </a>
                                <div class="ribbon-wrapper" method="GET" action="/">
                                    <button class="ribbon bg-danger" wire:click>
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <div class="modal fade" id="gallery{{ $k }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xxl" data-dismiss="modal" aria-label="Close">
                                    <div class="modal-content bg-transparent d-flex justify-content-center border-0" style="box-shadow: 0 0 0 0;">
                                        <img src="" class="img-fluid mb-2" alt="Gallery Image">
                                    </div>
                                </div>
                            </div>

                            @php ++$k; @endphp
                            @endforeach

                            {{-- Template For Java Script --}}

                            {{-- <div class="col-sm-2 border">
                                <a data-toggle="modal" data-target="#gallery">

                                    <img src="" class="img-fluid mb-2 w-100" alt="Gallery Image">

                                </a>
                                
                                <form class="ribbon-wrapper" method="GET" action="/">
                                    <button class="ribbon bg-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                            <div class="modal fade" id="gallery" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xxl" data-dismiss="modal" aria-label="Close">
                                    <div class="modal-content bg-transparent d-flex justify-content-center border-0" style="box-shadow: 0 0 0 0;">
                                        <img src="{{ asset('images/photos/11.jpg') }}" class="img-fluid mb-2" alt="Gallery Image">
                                    </div>
                                </div>
                            </div> --}}



                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row mb-4 pb-3">

            <div class="col-12">
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Tambah Kamar Baru" class="btn btn-success float-right">
            </div>

        </div>

    </section>
</form>
