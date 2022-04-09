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
                        @if ($keranjang->first())
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

            <div class="col-sm-5 col-md-4">

                @if (!empty($errors->all()))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

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

                <h3>Reservasi</h3>

                <form id="kamar_detail_form" method="POST" role="form" action="{{ route('kamar') }}" class="wowload fadeInRight">

                    <div class="form-group">
                        <input value="{{ session()->get('nama_tamu') }}" name="nama_tamu" type="text" class="form-control" placeholder="Nama*">
                    </div>

                    <div class="form-group">
                        <input value="{{ session()->get('email') }}" name="email" type="email" class="form-control" placeholder="Email*">
                    </div>

                    <div class="form-group">
                        <input value="{{ session()->get('no_tlp') }}" name="no_tlp" type="Phone" class="form-control" placeholder="No. Telepon*">
                    </div>

                    <div class="form-group">
                        <input value="{{ session()->get('jumlah_k') }}" name="jumlah_k" min="1" type="number" class="form-control" placeholder="Jumlah Kamar*">
                    </div>

                    <div class="form-group">
                        <input value="{{ session()->get('jumlah_d') }}" name="jumlah_d" min="1" type="number" class="form-control" placeholder="Jumlah Dewasa*">
                    </div>

                    <div class="form-group">
                        <input value="{{ session()->get('jumlah_a') }}" name="jumlah_a" type="number" class="form-control" placeholder="Jumlah Anak*">
                    </div>

                    <div class="form-group">
                        <textarea name="pesan_lain" class="form-control" placeholder="Pesan Lain" rows="4">{{ session()->get('pesan_lain') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="check_in">Check In</label>
                        <input value="{{ session()->get('check_in') }}" id="check_in" name="check_in" type="datetime-local" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="check_out">Check Out</label>
                        <input value="{{ session()->get('check_out') }}" id="check_out" name="check_out" type="datetime-local" class="form-control">
                    </div>

                    <input id="selesai_checkbox" name="selesai_checkbox" type="checkbox" class="form-control" style="display: inline-block;">
                    <label for="selesai_checkbox">Selesai pilih kamar<br>(opsional)</label>

                    <button id="cari_button" url="{{ route('kamar') }}" class="btn btn-default" style="float: right;">Pilih Kamar lagi</button>
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

                    @if (session()->has('id_cart'))
                    <div class="row" style="margin-bottom: 40px;">

                        <div class="wowload fadeInLeft" style="margin-top: 20px">


                            <table class="table table-bordered table-hover">

                                @if ($keranjang->first())
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
                    @endif

                </div>

                <div class="col-sm-5 col-md-4">

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

                    <h3>Reservasi</h3>

                    <div class="wowload fadeInRight">

                        <div class="form-group">
                            <input name="nama_tamu" type="text" class="form-control" placeholder="Nama*">
                        </div>

                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email*">
                        </div>

                        <div class="form-group">
                            <input name="no_tlp" type="Phone" class="form-control" placeholder="No. Telepon*">
                        </div>

                        <div class="form-group">
                            <input name="jumlah_k" min="1" type="number" class="form-control" placeholder="Jumlah Kamar*">
                        </div>

                        <div class="form-group">
                            <input name="jumlah_d" min="1" type="number" class="form-control" placeholder="Jumlah Dewasa*">
                        </div>

                        <div class="form-group">
                            <input name="jumlah_a" type="number" class="form-control" placeholder="Jumlah Anak*">
                        </div>

                        <div class="form-group">
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



                        @if (false)

                        @else
                        <input id="pilih_kamar_checkbox" name="pilih_kamar_checkbox" type="checkbox" class="form-control" style="display: inline-block;">
                        <label for="pilih_kamar_checkbox">Dengan pilih kamar<br>(opsional)</label>

                        <button class="btn btn-default" style="float: right;">Submit</button>
                        @endif

                    </div>

                </div>


            </div>
        </form>
        @endif


    </div>
</div>
<!-- reservation-information -->



<!-- services -->
<div class="spacer services wowload fadeInUp">

    <div class="container">

        <div class="row">

            <div class="col-sm-4">
                <!-- RoomCarousel -->

                <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="overflow-y: hidden; max-height: 225px;"> {{-- Untuk membatasi gambar --}}

                        <div class="item active">
                            <img src="images/photos/8.jpg" class="img-responsive" alt="slide">
                        </div>
                        <div class="item  height-full">
                            <img src="images/photos/9.jpg" class="img-responsive" alt="slide">
                        </div>
                        <div class="item  height-full">
                            <img src="images/photos/10.jpg" class="img-responsive" alt="slide">
                        </div>

                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#RoomCarousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="#RoomCarousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
                <!-- RoomCarousel-->
                <div class="caption">Ruangan

                    <a href="{{ route('kamar') }}" class="pull-right">
                        <i class="fa fa-edit"></i>
                    </a>

                </div>
            </div>


            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="FoodCarousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" style="overflow-y: hidden; max-height: 225px;"> {{-- Untuk membatasi gambar --}}

                        <div class="item active">
                            <img src="images/photos/1.jpg" class="img-responsive" alt="slide">
                        </div>

                        <div class="item  height-full">
                            <img src="images/photos/2.jpg" class="img-responsive" alt="slide">
                        </div>

                        <div class="item  height-full">
                            <img src="images/photos/5.jpg" class="img-responsive" alt="slide">
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#FoodCarousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>

                    <a class="right carousel-control" href="#FoodCarousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
                <!-- RoomCarousel-->

                <div class="caption">Food and Drinks
                    <a href="{{ route('gallery') }}" class="pull-right">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>


            </div>

            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="FacilityCarousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" style="overflow-y: hidden; max-height: 225px;"> {{-- Untuk membatasi gambar --}}
                        <div class="item active">
                            <img src="/images/photos/oioioi.jpg" class="img-responsive" alt="slide">
                        </div>

                        <div class="item  height-full">
                            <img src="images/photos/9.jpg" class="img-responsive" alt="slide">
                        </div>

                        <div class="item  height-full">
                            <img src="images/photos/10.jpg" class="img-responsive" alt="slide">
                        </div>

                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#FacilityCarousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>

                    <a class="right carousel-control" href="#FacilityCarousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
                <!-- RoomCarousel-->
                <div class="caption">Fasilitas
                    <a href="{{ route('kamar') }}" class="pull-right">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- services -->


@include('layout.footer')