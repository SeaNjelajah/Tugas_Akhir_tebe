@include('layout.header')

<!-- banner -->
<div class="banner">
    <img src="images/photos/banner.jpg" class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1 class="animated fadeInDown">BEANhotel</h1>
                <p class="animated fadeInUp">Hotel paling mewah di Indonesia dengan perawatan dan layanan pelanggan yang sangat baik.</p>
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">

    <div class="container">


        @if (session()->has('id_cart'))

        <div class="row" style="margin-bottom: 40px;">

            <div class="col-sm-7 col-md-8">
                <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.607106597192!2d112.73153831437119!3d-7.2854642736248945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbeb6a1ac669%3A0xbca18bc7af6e4881!2sJl.%20Diponegoro%20117-133%2C%20Darmo%2C%20Kec.%20Wonokromo%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060241!5e0!3m2!1sid!2sid!4v1643077198496!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>


                <div class="wowload fadeInLeft" style="margin-top: 20px">


                    <table class="table table-bordered table-hover">

                        @if (!empty($keranjang))
                        @if ($keranjang->first())
                        <strong style=" margin-bottom: 15px;">Keranjang</strong>

                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Kamar</th>
                                <th>Jumlah Kamar</th>
                                <th>Subtotal</th>
                                <th style="text-align: center"><i class="fa fa-wrench"></i></th>
                            </tr>

                        </thead>
                        @endif
                        @endif

                        <tbody>
                            @php $i = 0; $one = true @endphp

                            @foreach ($keranjang as $item)

                            @php
                            $kamar_item = $item->kamar()->first();
                            @endphp

                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>{{ ++$i }}</td>
                                <td>{{ $kamar_item->nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp, {{ number_format($kamar_item->harga) }}</td>
                                <td>Rp, {{ number_format($item->subtotal) }}</td>
                                <td style="text-align: center">
                                    <a set="kamar_hapus" append="#form_simpan_kamar" id_data="{{ $item->id_kamar }}" class="active btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>



                            @endforeach

                            <tr>
                                <td colspan="6">
                                    <hr style="margin-top: 7px; margin-bottom: -11px;">

                                    {{-- <div class="row" style="padding-left: 4px;">
                                        <label style="display: inline-block">Ri</label>
                                    </div> --}}

                                    <div class="row">

                                        <form id="form_simpan_kamar" enctype="multipart/form-data" class="col-sm-6" style="margin-top: 28px;" method="POST" action="{{ route('keranjang') }}">
                                            @csrf
                                            @method('PUT')

                                            <button class="btn btn-default">Simpan</button>
                                        </form>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Total: </label>
                                                <h4 class="form-control">Rp. {{ number_format($keranjang->sum('subtotal')) }}</h4>
                                            </div>
                                        </div>

                                    </div>


                                </td>
                            </tr>

                        </tbody>
                    </table>


                </div>


            </div>

            <div class="col-sm-5 col-md-4">

                @if (!empty($errors->all()))
                <div class="alert alert-danger alert-dismissible show" role="alert">

                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">

                    <div class="col-sm-6">
                        <h3>Reservasi</h3>
                    </div>

                    <div class="col-sm-6">
                        <a class="btn btn-default" href="{{ route('ulang') }}" style="float: right">Ulang</a>
                    </div>

                </div>


                <form id="kamar_detail_form" method="POST" role="form" action="{{ route('selesai') }}" class="wowload fadeInRight">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Tamu</label>
                        <input disabled value="{{ session()->get('nama_tamu') }}" type="text" class="form-control" placeholder="Nama*">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input disabled value="{{ session()->get('email') }}" type="email" class="form-control" placeholder="Email*">
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input disabled value="{{ session()->get('no_tlp') }}" type="Phone" class="form-control" placeholder="No. Telepon*">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Kamar</label>
                        <input disabled value="{{ session()->get('jumlah_k') }}" min="1" type="number" class="form-control" placeholder="Jumlah Kamar*">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Orang Dewasa</label>
                        <input disabled value="{{ session()->get('jumlah_d') }}" min="1" type="number" class="form-control" placeholder="Jumlah Dewasa*">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Anak - anak</label>
                        <input disabled value="{{ session()->get('jumlah_a') }}" type="number" class="form-control" placeholder="Jumlah Anak*">
                    </div>

                    <div class="form-group">
                        <label>Pesan Lain</label>
                        <textarea disabled class="form-control" placeholder="Pesan Lain" rows="4">{{ session()->get('pesan_lain') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="check_in">Check In</label>
                        <input disabled value="{{ session()->get('check_in') }}" id="check_in" type="datetime-local" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="check_out">Check Out</label>
                        <input disabled value="{{ session()->get('check_out') }}" id="check_out" type="datetime-local" class="form-control">
                    </div>

                    <input id="selesai_checkbox" name="selesai_checkbox" type="checkbox" class="form-control" style="display: inline-block;">
                    <label for="selesai_checkbox">Selesai pilih kamar</label>

                    <a id="cari_button" href="{{ route('kamar') }}" class="btn btn-default" style="float: right;">Pilih Kamar lagi</a>
                    <button id="selesai_button" url="{{ route('selesai') }}" class="btn btn-default d-none" style="float: right;">Selesai</button>
                </form>


            </div>


        </div>

        @else


        <form method="POST" role="form" action="{{ route('home.submit') }}">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-sm-7 col-md-8">
                    <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.607106597192!2d112.73153831437119!3d-7.2854642736248945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbeb6a1ac669%3A0xbca18bc7af6e4881!2sJl.%20Diponegoro%20117-133%2C%20Darmo%2C%20Kec.%20Wonokromo%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060241!5e0!3m2!1sid!2sid!4v1643077198496!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>


                    <div class="row" style="margin-bottom: 40px;">

                        <div class="wowload fadeInLeft" style="margin-top: 20px">


                            <table class="table table-bordered table-hover">

                                @if (!empty($keranjang))
                                <strong style=" margin-bottom: 15px;">Keranjang</strong>

                                <thead>

                                    <tr>
                                        <th>No</th>
                                        <th>Kamar</th>
                                        <th>Jumlah Kamar</th>
                                        <th>Subtotal</th>
                                    </tr>

                                </thead>
                                @endif

                                <tbody>
                                    @php $i = 0; @endphp

                                    @foreach ($keranjang as $item)

                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->kamar()->first()->nama }}.</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>Rp, {{ $item->subtotal }}</td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>


                        </div>

                    </div>


                </div>

                <div class="col-sm-5 col-md-4">

                    @if (!empty($errorBag = $errors->all()))
                    <div class="alert alert-danger alert-dismissible show" role="alert">

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

                    <h3>Reservasi</h3>

                    <div class="wowload fadeInRight">

                        <div class="form-group">
                            <label>Nama Tamu</label>
                            <input name="nama_tamu" type="text" class="form-control" placeholder="Nama*">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" placeholder="Email*">
                        </div>

                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input name="no_tlp" type="Phone" class="form-control" placeholder="No. Telepon*">
                        </div>

                        <div class="form-group">
                            <label>Jumlah Kamar</label>
                            <input name="jumlah_k" min="1" type="number" class="form-control" placeholder="Jumlah Kamar*">
                        </div>

                        <div class="form-group">
                            <label>Jumlah Orang Dewasa</label>
                            <input name="jumlah_d" min="1" type="number" class="form-control" placeholder="Jumlah Dewasa*">
                        </div>

                        <div class="form-group">
                            <label>Jumlah Anak - Anak</label>
                            <input name="jumlah_a" type="number" class="form-control" placeholder="Jumlah Anak*">
                        </div>

                        <div class="form-group">
                            <label>Pesan Lain</label>
                            <textarea name="pesan_lain" class="form-control" placeholder="Pesan Lain" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="check_in">Check In</label>
                            <input id="check_in" name="check_in" type="datetime-local" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="check_out">Check Out</label>
                            <input id="check_out" name="check_out" type="datetime-local" class="form-control">
                        </div>



                        <input id="pilih_kamar_checkbox" name="pilih_kamar_checkbox" type="checkbox" class="form-control" style="display: inline-block;">
                        <label for="pilih_kamar_checkbox">Dengan pilih kamar<br>(opsional)</label>

                        <button class="btn btn-default" style="float: right;">Submit</button>

                        <p>
                            Tanpa memilih atau mencentang checkbox diatas,
                            maka kami assumsikan bahwa anda ingin memesan reservasi sesuai dengan Pesan Lain anda.
                            yang kami penuhi sesuai dengan Interpretasi kami pada Pesan Lain anda.
                        </p>

                    </div>

                </div>


            </div>
        </form>


        @endif


    </div>



</div>
<!-- reservation-information -->



<!-- services -->
@include('carousel')
<!-- services -->


@include('layout.footer')