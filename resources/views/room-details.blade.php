@include('layout.header')
{{-- <php include 'header.php';?> --}}

<div class="container">

    <h1 class="title">{{ $kamar->nama }}</h1>

    <!-- RoomDetails -->
    <div id="RoomDetails" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">

            @php
            $active = true;
            @endphp
            
            @foreach ($kamar->gambar as $gambar)

            <div class="item {{ ($active) ? 'active' : 'height-full' }}">
                <img src="{{ asset('storage/kamar/' . $gambar->gambar) }}" class="img-responsive" alt="slide">
            </div>

            @php
            $active = false;
            @endphp

            @endforeach

        </div>
        <!-- Controls -->

        <a class="left carousel-control" href="#RoomDetails" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right carousel-control" href="#RoomDetails" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>

    </div>
    <!-- RoomCarousel-->

    <div class="room-features spacer">

        <div class="row">

            <div class="col-sm-12 col-md-5">
                <p>{{ $kamar->deskripsi }}</p>
                {{-- <p>By Learning Ways To Become Peaceful. One of the greatest barriers to making the sale is your prospect's natural. Don't stubbornly. Don't stubbornly. Don't stubbornly. -And Gain Power By Learning Ways To Become Peaceful. </p> --}}
            </div>

            <div class="col-sm-6 col-md-3 amenitites">

                <h3>Fasilitas</h3>

                <ul>
                    @foreach ($kamar->fasilitas as $fasilitas)
                    
                    <li>{{ $fasilitas->fasilitas }}</li>
                    
                    {{-- <li>Principle to work to make more money while having more fun.</li>
                    <li>Unlucky people. Don't stubbornly.</li>
                    <li>Principle to work to make more money while having more fun.</li>
                    <li>Space in your house How to sell faster than your neighbors</li> --}}
                    @endforeach
                </ul>

            </div>

            <div class="col-sm-3 col-md-2">

                <div class="size-price">Ukuran<span>{{ $kamar->ukuran }} m²</span></div>

            </div>

            <div class="col-sm-3 col-md-2">

                <div class="size-price">Harga<span>Rp {{ number_format($kamar->harga) }}</span></div>

            </div>

        </div>

    </div>


    <div class="row" style="margin-bottom: 40px;">

        <div class="col-sm-7 col-md-8">
            <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.607106597192!2d112.73153831437119!3d-7.2854642736248945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbeb6a1ac669%3A0xbca18bc7af6e4881!2sJl.%20Diponegoro%20117-133%2C%20Darmo%2C%20Kec.%20Wonokromo%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060241!5e0!3m2!1sid!2sid!4v1643077198496!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
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


{{-- <php include 'footer.php';?> --}}

@include('layout.footer')