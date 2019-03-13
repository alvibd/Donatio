<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Donatio</title>
    <!-- Favicon-->
<link rel="icon" href="{{ asset('admin/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
<link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
<link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
<link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <style>
        body{
            background-image: url({{ asset('admin/images/image-gallery/landscape.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line {{ $errors->has('email') ? 'focused error' : ''}}">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Username" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                            <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line {{ $errors->has('password') ? 'focused error' : ''}}">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="col-xs-6 align-right">
                                <a href="forgot-password.html">Forgot Password?</a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>