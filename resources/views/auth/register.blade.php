<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | Donatio</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('admin/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            background-image: url({{ asset('admin/images/image-gallery/landscape.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><b>Donatio</b></a>
        <small>Help Make The World A Better Place</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="msg">Register a new membership</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line {{ $errors->has('first_name') ? 'focused error' : ''}}">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required autofocus>
                    </div>
                    @if ($errors->has('first_name'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person_outline</i>
                        </span>
                    <div class="form-line {{ $errors->has('last_name') ? 'focused error' : ''}}">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                    </div>
                    @if ($errors->has('last_name'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">business</i>
                        </span>
                    <div class="form-line {{ $errors->has('company_name') ? 'focused error' : ''}}">
                        <input type="text" class="form-control" name="company_name" placeholder="Organization Name" required>
                    </div>
                    @if ($errors->has('company_name'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">plus_one</i>
                        </span>
                    <div class="form-line {{ $errors->has('registration_no') ? 'focused error' : ''}}">
                        <input type="text" class="form-control" name="registration_no" placeholder="Registration No" required>
                    </div>
                    @if ($errors->has('registration_no'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('registration_no') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">location_on</i>
                        </span>
                    <div class="form-line {{ $errors->has('address') ? 'focused error' : ''}}">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                    </div>
                    @if ($errors->has('address'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line {{ $errors->has('email') ? 'focused error' : ''}}">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="email" required>
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
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password_confirm" minlength="6"
                               placeholder="Confirm Password" required>
                    </div>
                    @if ($errors->has('password_confirm'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('password_confirm') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink" required>
                    <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    @if ($errors->has('terms'))
                        <span class="col-pink" role="alert">
                                <strong>{{ $errors->first('terms') }}</strong>
                        </span>
                    @endif
                </div>

                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                <div class="m-t-25 m-b--5 align-center">
                    <a href="{{ route('login') }}">You already have a membership?</a>
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