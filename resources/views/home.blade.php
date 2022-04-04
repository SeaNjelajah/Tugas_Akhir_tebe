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

        <div class="row">

            <div class="col-sm-7 col-md-8">
                <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.607106597192!2d112.73153831437119!3d-7.2854642736248945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbeb6a1ac669%3A0xbca18bc7af6e4881!2sJl.%20Diponegoro%20117-133%2C%20Darmo%2C%20Kec.%20Wonokromo%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060241!5e0!3m2!1sid!2sid!4v1643077198496!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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

                <form method="POST" role="form" class="wowload fadeInRight">

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

                    <button class="btn btn-default">Submit</button>
                    
                </form>

            </div>

            
        </div>
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