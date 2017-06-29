<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Ionicons -->
        <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
        <!-- Theme style -->
        <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link href="{{ asset('css/_all-skins.min.css') }}" rel="stylesheet">
        <!-- Datepicker -->
        <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet">
        <!-- Sweet Alert -->
        <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
        <!-- Multiselect -->
        <link href="{{ asset('css/multiselect.min.css') }}" rel="stylesheet">
        <!-- Select2 -->
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a>宮崎<b>大学校</a>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">Register a new teacher</p>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box <-->
    </body>
@section('script')
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('/js/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('/js/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/js/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/js/demo.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('/js/bootstrap-datepicker.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/js/icheck.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/js/select2.min.js') }}"></script>
    <!-- Multiselect -->
    <script src="{{ asset('/js/multiselect.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('/js/sweetalert-dev.js') }}"></script>

@show
</html>

