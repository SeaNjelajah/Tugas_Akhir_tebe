<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>BEAN.com | teBEandriAN</title>

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>

    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


   

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />


    <!-- uniform -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/uniform/css/uniform.default.min.css') }}" />

    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('assets/wow/animate.css') }}" />


    <!-- gallery -->
    <link rel="stylesheet" href="{{ asset('assets/gallery/blueimp-gallery.min.css') }}">


    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <style>

      .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -7.5px;
        margin-left: -7.5px;
      }


      .col {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
      }

      .d-none {
        display: none!important;
      }
      
    </style>
</head>

<body id="home">


    <!-- top
  <form class="navbar-form navbar-left newsletter" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Your Email Id Here">
        </div>
        <button type="submit" class="btn btn-inverse">Subscribe</button>
    </form>
 top -->

    <!-- header -->
    <nav class="navbar  navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="font-size:50px; display:flex; align-items:center;">
                    {{-- <img src="images/logo.png"  alt="holiday crown"> --}}
                    BEAN.COM
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">

                    <li>
                      <a href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li>
                      <a href="{{ route('kamar') }}">Kamar dan Biaya</a>
                    </li>

                    <li>
                      <a href="{{ route('pengantar') }}">Pengantar</a>
                    </li>

                    <li>
                      <a href="{{ route('gallery') }}">Galeri</a>
                    </li>

                    <li>
                      <a href="{{ route('contact') }}">Kontak Person</a>
                    </li>

                </ul>
            </div><!-- Wnavbar-collapse -->
        </div><!-- container-fluid -->
    </nav>
    <!-- header -->