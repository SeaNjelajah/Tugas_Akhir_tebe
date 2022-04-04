@include('layout.header')

<div class="container">

    <h2>Kamar dan Harga</h2>


    <!-- form -->

    <div class="row" style="box-sizing: border-box">
        
        @foreach ($banyak_kamar as $kamar)
    
        @php
        $gambar_utama = $kamar->gambar_utama() or false;
        @endphp
        <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                @if ($gambar_utama)
                <img src="{{ asset('storage/kamar/' . $kamar->gambar_utama()->gambar ) }}" width="100%" class="img-responsive">
                @else 
                <img src="{{ asset('images/NoImage.png') }}" class="img-responsive" width="100%">
                @endif

                <div class="info">
                    <h3>{{ $kamar->nama }}</h3>
                    <p>{{ $kamar->deskripsi }}</p>
                    <a href="{{ route('kamar.detail', $kamar->id) }}" class="btn btn-default">Rp.{{ number_format($kamar->harga, 2) }}</a>
                </div>
            </div>

        </div>

        @endforeach

        <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                <img src="{{ asset('images/photos/9.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Executive Deluxe Room</h3>
                    <p>Executive Deluxe Room tersedia dalam tempat tidur double dan twin, lengkap dengan kamar mandi pribadi yang di lengkapi dengan bathub.</p>
                    <a href="room-details.php" class="btn btn-default">Rp.165.000,00</a>
                </div>
            </div>

        </div>


        {{-- <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                <img src="{{ asset('images/photos/10.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Bantalan bergaya ini menggabungkan dekorasi minimalis dan kenyamanan modern hotel Urban di Surabaya, yang dirancang untuk istirahat dengan keraguan tinggi.</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>

        </div>


        <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                <img src="{{ asset('images/photos/11.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Nikmati matahari dan nikmati pemandangan indah Surabaya dari balkon pribadi, atau hanya meringkuk di daybed Anda tidak pernah santai seperti apa yang manfaat ruangan ini bagi Anda.</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>

        </div>


        <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                <img src="{{ asset('images/photos/9.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Ruangan ini adalah segalanya liburan dengan keluarga atau teman-teman harus - pribadi, damai dan senyaman mungkin. Nikmati meja makan yang unik, untuk sekadar memiliki roti istirahat.</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>

        </div>


        <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                <img src="{{ asset('images/photos/8.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p>Masing-masing kamar yang luas ini dirancang untuk kenyamanan yang tak tertandingi, dilengkapi dengan fasilitas dan teknologi modern untuk memanjakan dan menghibur.</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>

        </div>


        <div class="col-sm-6 wowload fadeInUp">

            <div class="rooms">
                <img src="{{ asset('images/photos/10.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>
            
        </div>


        <div class="col-sm-6 wowload fadeInUp">
            <div class="rooms">
                <img src="{{ asset('images/photos/11.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>
        </div>


        <div class="col-sm-6 wowload fadeInUp">
            <div class="rooms">
                <img src="{{ asset('images/photos/9.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>
        </div>


        <div class="col-sm-6 wowload fadeInUp">
            <div class="rooms">
                <img src="{{ asset('images/photos/8.jpg') }} " class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>
        </div>


        <div class="col-sm-6 wowload fadeInUp">
            <div class="rooms">
                <img src="{{ asset('images/photos/11.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>
        </div>


        <div class="col-sm-6 wowload fadeInUp">
            <div class="rooms">
                <img src="{{ asset('images/photos/10.jpg') }}" class="img-responsive">
                <div class="info">
                    <h3>Luxirious Suites</h3>
                    <p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p>
                    <a href="room-details.php" class="btn btn-default">Check Details</a>
                </div>
            </div>
        </div> --}}


    </div>

</div>


@include('layout.header')