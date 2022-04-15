{{-- <php //include 'header.php';?> --}}
@include('layout.header')

<div class="container">

    <h1 class="title">Contact</h1>

    <!-- form -->
    
    <div class="contact">
		
        <div class="row">

            <div class="col-sm-12">

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9933.460884430251!2d-0.13301252240929382!3d51.50651527467666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2snp!4v1414314152341" width="100%" height="300" frameborder="0"></iframe>
                </div>


                <div class="col-sm-6 col-sm-offset-3">

                    <div class="spacer">

                        <h4>Write to us</h4>
                        @if ( session()->get('success') )
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h3>
                                <i class="fa fa-check"></i> Success!
                            </h3>
                            Your message have been stored
                        </div>
                        @endif

                        @if($value = $errors->all())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h3>
                                <i class="icon fa fa-ban"></i> Alert!
                            </h3>

                            @foreach ($value as $error)
                            <ul>
                                <li>{{ $error }}</li>
                            </ul>
                            @endforeach

                        </div>
                        @endif

                        <form role="form" action="{{ route('contact.save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nama" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <input type="phone" name="phone" class="form-control" id="phone" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <textarea type="email" name="pesan" class="form-control" placeholder="Message" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn btn-default">KIRIM</button>

                        </form>

                    </div>


                </div>





            </div>
        </div>
    </div>
    <!-- form -->

</div>

@include('layout.footer')