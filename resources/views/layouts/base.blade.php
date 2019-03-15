<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('page_title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('admin/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

@section('stylesheets')
    <!-- Bootstrap Core Css -->
        <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet"/>

        <!-- Animation Css -->
        <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet"/>

        <!-- Custom Css -->
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ asset('admin/css/themes/all-themes.css') }}" rel="stylesheet"/>

        @stack('push_stylesheets')
    @show
</head>

<body class="theme-cyan">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
@include('layouts.topbar')
<section>
    @include('layouts.leftbar')
</section>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>@yield('page_title')</h2>
        </div>

        @section('error_message')
            @if(count($errors)>0)

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Error
                            </h2>
                        </div>
                        <div class="body">
                            <div class="alert alert-danger">
                                <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @show

        @if (session('status'))
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</section>

@section('javascripts')
    @routes
    <!-- Jquery Core Js -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('admin/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/pages/index.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('admin/js/demo.js') }}"></script>
@show
@stack('push_javascripts')
</body>

</html>
