@include('layout.header')

<div class="container">

    @foreach ($gallery_list as $list)

    <h1 class="title wowload fadeInUp">{{ $list }}</h1>

    <hr style="margin-top: -20px">
    
    <div class="row gallery">
        @foreach ($gallery_image->where('gallery', $list) as $image)
            
        <div class="col-sm-4 wowload fadeInUp">
            <a href="{{ asset('storage/gallery/' . $image->gambar) }}" title="{{ $list }}" class="gallery-image" data-gallery>
                <img src="{{ asset('storage/gallery/' . $image->gambar) }}" class="img-responsive">
            </a>
        </div>

        @endforeach
        
    </div>

    @endforeach


@include('layout.footer')