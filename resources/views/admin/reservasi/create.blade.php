@extends('admin.layout.app')

@section('header')
<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0">Reservasi</h1>
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
<form method="POST" role="form" action="{{ route('admin.reservasi.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Buat Reservasi</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-12">

                    @if (!empty($errorBag = $errors->all()))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        <ul>
                            @foreach ($errorBag as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif

                    <div class="wowload fadeInRight">

                        <div class="form-group">
                            <label for="nama_tamu">Nama Tamu</label>

                            <input id="nama_tamu" value="{{ old('nama_tamu') }}" required name="nama_tamu" type="text" class="form-control" placeholder="Nama*">

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>

                            <input id="email" required value="{{ old('email') }}" name="email" type="email" class="form-control" placeholder="Email*">

                        </div>

                        <div class="form-group">
                            <label for="no_tlp">Nomor Telepon</label>

                            <input id="no_tlp" required value="{{ old('no_tlp')  }}" name="no_tlp" type="Phone" class="form-control" placeholder="No. Telepon*">

                        </div>

                        <div class="form-group">

                            <label for="jumlah_k">Jumlah Kamar</label>
                            <input id="jumlah_k" required value="{{ old('jumlah_k') | '1' }}" name="jumlah_k" min="1" type="number" class="form-control" placeholder="Jumlah Kamar*">

                        </div>

                        <div class="form-group">
                            <label for="jumlah_d">Jumlah Dewasa</label>

                            <input id="jumlah_d" required value="{{ old('jumlah_d') | '1' }}" name="jumlah_d" min="1" type="number" class="form-control" placeholder="Jumlah Dewasa*">

                        </div>

                        <div class="form-group">
                            <label for="jumlah_a">Jumlah Anak <sup>2</sup> </label>
                            <input id="jumlah_a" required name="jumlah_a" value="{{ old('jumlah_a') | '0' }}" min="0" type="number" class="form-control" placeholder="Jumlah Anak*">
                        </div>

                        <div class="form-group">
                            <label for="pesan_lain">Pesan Lain</label>
                            <textarea id="pesan_lain" required name="pesan_lain" class="form-control" placeholder="Pesan Lain" rows="4">{{ old('pesan_lain') }}</textarea>
                        </div>



                    </div>

                </div>

                <div class="col-12">


                    <div class="form-group">

                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input id="check_in_checkbox" name="check_in_checkbox" type="checkbox" class="mr-3"> Check In
                            </div>

                            <input disabled id="check_in_input" type="datetime-local" name="check_in" class="form-control">

                        </div>

                        <small>Silakan Centang Checkbox Jika Reservasi untuk Tamu Yang Belum Datang</small>
                    </div>


                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Check Out
                            </div>

                            <input required type="datetime-local" name="check_out" class="form-control">
                        </div>


                    </div>




                </div>


            </div>

        </div>

    </div>

    <div class="card card-primary mt-2" id="card_pilih_kamar">

        <div class="card-header">
            <div class="row p-0 m-0">

                <div class="col-auto p-0 m-0">
                    <h3 class="m-0 card-title mr-auto">Pilih Kamar</h3>
                </div>

                <div class="col-auto ml-auto p-0 m-0 mr-2">
                    <h4 id="kamar_terpilih" class="m-0 card-title">0 Kamar Terpilih</h4>
                </div>

                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>


            </div>

            

        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kamar</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>


                    @foreach ($banyak_kamar as $kamar)
                    @php
                    $gambar_utama = $kamar->gambar_utama() or false;
                    @endphp
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td>{{ $kamar->id }}</td>
                        <td>{{ $kamar->nama }}</td>
                        <td>{{ $kamar->ukuran }} m²</td>
                        <td>Rp, {{ number_format($kamar->harga) }}</td>
                        <td>{{ $kamar->status }}</td>
                    </tr>

                    <tr class="expandable-body d-none">
                        <td colspan="5">

                            <div class="card m-0">
                                <div class="row">

                                    <div class="col-4">

                                        @if ($gambar_utama)
                                        <img class="img-fluid w-100" src="{{ asset('storage/kamar/' . $gambar_utama->gambar) }}" alt="Gambar Kamar">
                                        @else
                                        <img class="img-fluid w-100" src="{{ asset('images/NoImage.png') }}" alt="Gambar Kamar">
                                        @endif

                                    </div>

                                    <div class="col">
                                        <div class="row h-100">

                                            <div class="col-12 h-75">
                                                <p>
                                                    {{ $kamar->deskripsi }}
                                                </p>
                                            </div>

                                            <div class="col-12">

                                                <div class="float-right pl-3">
                                                    <strong>Kamar Tersisa:</strong>
                                                    {{ $kamar->jumlah_kamar }}
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="card-footer d-inline-flex justify-content-end">
                                    {{-- <a href="{{ route('admin.kamar.show', $kamar->id) }}" class="btn btn-primary">Rincian</a>
                                    <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="btn btn-warning">Edit</a>
                                    <a data-toggle="modal" data-target="#modal_delete{{ $kamar->id }}" href="#" class="float-right btn btn-danger">Hapus</a> --}}
                                    
                                    <label for="id_jumlah_kamar_terpilih" class="my-auto mr-1">Jumlah Kamar: </label>
                                    <input value="{{ (empty(old('kamar_terpilih')[$kamar->id]) ? '0' : $value) }}"  set="jumlah_kamar_terpilih"  class="w-25 form-control mr-1" type="number" min="0" id="id_jumlah_kamar_terpilih">
                                    <a set="pilih" class="active btn btn-primary">Pilih</a>

                                </div>


                            </div>

                        </td>
                    </tr>


                    @endforeach

                </tbody>
            </table>

        </div>

        @if (!empty(old('kamar_terpilih')))
            @foreach (old('kamar_terpilih') as $key => $value)
            <input set="terpilih" type="hidden" name="kamar_terpilih[{{ $key }}]" value="{{ $value }}">
            @endforeach
        @endif

    </div>

    <button class="btn btn-primary float-right px-3">Submit</button>
    <div class="py-4"></div>
</form>
@endsection

@section('script')
<script>
    $('#check_in_checkbox').on('change', (e) => {
        source = e.target;
        target = document.getElementById('check_in_input');

        if (target.disabled) {
            target.disabled = false;
        }
        else {
            target.disabled = true;
        }

    });

    const card_pilih_kamar = document.getElementById('card_pilih_kamar');
    const kamar_terpilih_text = document.getElementById('kamar_terpilih');
    
    $('a[set=pilih]').on('click', (e) => {
        source = e.target;

        jumlah_kamar_terpilih_input = source.parentElement.querySelector('input');

        jumlah_kamar = source.parentElement.parentElement.firstElementChild.lastElementChild.lastElementChild.lastElementChild.lastElementChild.innerText;
        jumlah_kamar = jumlah_kamar.replaceAll(/[^0-9]/g, '');
        jumlah_kamar = Number(jumlah_kamar);

        if (jumlah_kamar_terpilih_input.value < 0) {
            jumlah_kamar_terpilih_input.value = 0;
        } else if (jumlah_kamar_terpilih_input.value > jumlah_kamar) {
            jumlah_kamar_terpilih_input.value = jumlah_kamar;
        }

        data_kamar = source.parentElement.parentElement.parentElement.parentElement.previousElementSibling.children;
        id_kamar = Number(data_kamar[0].innerText);

        input_ = card_pilih_kamar.querySelectorAll('input[set=terpilih]');
        

        source_hidden_input = false;

        for (i = 0; i < input_.length; i++) {
            if (input_[i].name.replaceAll(/[^0-9]/g, '') == id_kamar) {
                source_hidden_input = input_[i];
                break;
            }
        }
        
        if (source_hidden_input) {
            

            if (jumlah_kamar_terpilih_input.value == 0) {
                source_hidden_input.remove();
            } else if (jumlah_kamar_terpilih_input.value != source_hidden_input.value) {
                source_hidden_input.value = jumlah_kamar_terpilih_input.value;
            }

        } else if (jumlah_kamar_terpilih_input.value > 0) {

            new_input = document.createElement('input');
            new_input.name = "kamar_terpilih[" + id_kamar + "]";
            new_input.value = jumlah_kamar_terpilih_input.value;
            new_input.type = "hidden";
            new_input.setAttribute('set', 'terpilih');

            card_pilih_kamar.appendChild(new_input);

        }
        
        count = card_pilih_kamar.querySelectorAll('input[set=terpilih]').length;
        kamar_terpilih_text.innerText = count + " Kamar Terpilih";


    });

    $('input[set=jumlah_kamar_terpilih]').on('change', (e) => {
        source = e.target;

        jumlah_kamar = source.parentElement.parentElement.firstElementChild.lastElementChild.lastElementChild.lastElementChild.lastElementChild.innerText;
        jumlah_kamar = jumlah_kamar.replaceAll(/[^0-9]/g, '');
        jumlah_kamar = Number(jumlah_kamar);

        if (source.value < 0) {
            source.value = 0;
        } else if (source.value > jumlah_kamar) {
            source.value = jumlah_kamar;
        }

    });

    $(document).ready (() => {

        setTimeout(() => {
            count = card_pilih_kamar.querySelectorAll('input[set=terpilih]').length;
            kamar_terpilih_text.innerText = count + " Kamar Terpilih";
        }, 800);
        
    });

</script>
@endsection