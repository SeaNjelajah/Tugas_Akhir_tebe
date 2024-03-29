<footer class="spacer">

    <div class="container">

        <div class="row">

            <div class="col-sm-5">
                <h4>BEAN.com</h4>

                <p>
                    Keramahan yang sangat baik tidak pernah ketinggalan zaman. Untuk tinggal jauh dari rumah bukan hanya tentang "tidur semalaman" lagi. Kami percaya bahwa pengalaman sebagai masalah keseluruhan adalah yang paling penting. Dengan menawarkan layanan dan fasilitas yang dipersonalisasi dalam sistem teknologi modern dan ramah pengguna, hotel kami mencoba menggabungkan konsep staycation kontemporer dengan harapan tertinggi Anda untuk tinggal.
                </p>

            </div>

            <div class="col-sm-3">

                <h4>Quick Links</h4>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('kamar') }}" >Rooms & Tariff</a>
                    </li>
                    
                    <li>
                        <a href="{{ route('pengantar') }}" >Introduction</a>
                    </li>
                    
                    <li>
                        <a href="{{ route('gallery') }}" >Gallery</a>
                    </li>
                    
                    {{-- <li>
                        <a href="#" >Tour Packages</a>
                    </li> --}}
                    
                    <li>
                        <a href="{{ route('contact') }}" >Contact</a>
                    </li>

                </ul>

            </div>

            <div class="col-sm-4 subscribe">

                <h4>Subscription</h4>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter email id here">
                    
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Get Notify</button>
                    </span>
                </div>

                <div class="social">

                    <a href="#">
                        <i class="fa fa-facebook-square" data-toggle="tooltip" data-placement="top" data-original-title="facebook"></i>
                    </a>
                    
                    <a href="#">
                        <i class="fa fa-instagram" data-toggle="tooltip" data-placement="top" data-original-title="instragram"></i>
                    </a>
                    
                    <a href="#">
                        <i class="fa fa-twitter-square" data-toggle="tooltip" data-placement="top" data-original-title="twitter"></i>
                    </a>
                    
                    <a href="#">
                        <i class="fa fa-pinterest-square" data-toggle="tooltip" data-placement="top" data-original-title="pinterest"></i>
                    </a>
                    
                    <a href="#">
                        <i class="fa fa-tumblr-square" data-toggle="tooltip" data-placement="top" data-original-title="tumblr"></i>
                    </a>
                    
                    <a href="#">
                        <i class="fa fa-youtube-square" data-toggle="tooltip" data-placement="top" data-original-title="youtube"></i>
                    </a>

                </div>


            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->

    <!--/.footer-bottom-->
</footer>

<div class="text-center copyright">Powered by <a href="http://thebootstrapthemes.com">andriantebe.com</a></div>

<a href="#home" class="toTop scroll"><i class="fa fa-angle-up"></i></a>




<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
</div>





<script src="{{ asset('assets/jquery.js') }}"></script>

<!-- wow script -->
<script src="{{ asset('assets/wow/wow.min.js') }}"></script>

<!-- uniform -->
<script src="{{ asset('assets/uniform/js/jquery.uniform.js') }}"></script>


<!-- boostrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>

<!-- jquery mobile -->
<script src="{{ asset('assets/mobile/touchSwipe.min.js') }}"></script>

<!-- jquery mobile -->
<script src="{{ asset('assets/respond/respond.js') }}"></script>

<!-- gallery -->
<script src="{{ asset('assets/gallery/jquery.blueimp-gallery.min.js') }}"></script>


<!-- custom script -->
<script src="{{ asset('assets/script.js') }}"></script>










</body>

</html>