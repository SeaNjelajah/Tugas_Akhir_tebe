<div class="spacer services wowload fadeInUp">

    <div class="container">

        <div class="row">
            @foreach ($gallery_list as $list)
            
            <div class="col-sm-4">
                <!-- RoomCarousel -->

                <div id="{{ str_replace(" ", "", $list) }}Carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="overflow-y: hidden; max-height: 225px;"> {{-- Untuk membatasi gambar --}}
                        @php $active = true @endphp
                        @foreach ($gallery_image->where('gallery', $list) as $image)                        
                        <div class="item @if ($active) active @endif">
                            <img src="{{ asset('storage/gallery/' . $image->gambar ) }}" class="img-responsive" alt="slide">
                        </div>
                        @php $active = false @endphp
                        @endforeach

                    </div>
                    <!-- Controls -->

                    <a class="left carousel-control" href="#{{ str_replace(" ", "", $list) }}Carousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>

                    <a class="right carousel-control" href="#{{ str_replace(" ", "", $list) }}Carousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
                <!-- RoomCarousel-->
                <div class="caption">{{ $list }}

                    <a href="{{ route('gallery') }}" class="pull-right">
                        <i class="fa fa-edit"></i>
                    </a>

                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>