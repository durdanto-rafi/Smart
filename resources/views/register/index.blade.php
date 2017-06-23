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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($lblMessage = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $lblMessage }}</p>
                    </div>
                @endif

                {!! Form::open(array('route' => 'register.store','method'=>'POST','id'=>'frmRegistration')) !!}
                    <div class="form-group has-feedback">
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::select('university_id', [], null, ['class'=>'select2-single form-control', 'id'=>'cross_match_id']) !!}
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::text('faculty', null, array('placeholder' => 'Faculty','class' => 'form-control')) !!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="social-auth-links text-center">
                        <p> Please click the right icon and select the specialities that meet your type</p>
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::select('societies[]', $societies, null, ['multiple' => 'multiple', 'class'=>'form-control', 'id'=>'ddlSocieties']) !!}
                    </div>

                    <div class="social-auth-links text-center">
                        <p> If none of these conditions applies to you, please input the society what is closed to your specialty</p>
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::text('speciality', null, array('placeholder' => 'Speciality','class' => 'form-control')) !!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::text('email', null, array('placeholder' => 'Email', 'class' => 'form-control', 'id'=>'txtEmail')) !!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {!! Form::text('username', null, array('placeholder' => 'Username', 'class' => 'form-control', 'id'=>'txtUsername')) !!}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'id'=>'txtPassword')) }}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {{ Form::password('confirm_password', array('placeholder'=>'Retype Password', 'class'=>'form-control', 'id'=>'txtConfirmPassword' )) }}
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-8">
                            <div id="lblMessage">
                                
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" onclick="submit_form();" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {!! Form::close() !!}

                <a href="{{ route('login.index') }}" class="text-center">I already have a membership</a>
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

    <script type="text/javascript">
        var path = "{{ route('universityList') }}";
        var check = 0;
        $('.select2-single').select2({
            placeholder: 'Please type to search University name',
            ajax: {
            url: path,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
            }
        });

        $("#ddlSocieties").multiselect({
            title: "Please select the options where you belong to"
        });

        $("#txtUsername").change(function(){
            $("#lblMessage").html("checking...");
            var username=$("#txtUsername").val();
            var token = $("input[name='_token']").val();
            $.ajax({
                type:"post",
                dataType: "json",
                url :"{{ route('checkUser') }}",
                data: {username: username, _token:token},
                    success:function(data){
                    if(data.status == true){
                        $('#lblMessage').html('Sorry, Username already exists !').css('color', 'red');
                        check = 2;
                    }
                    else{
                        $('#lblMessage').html('Username available !').css('color', 'green');
                        check = 1;
                    }
                }
            });
        });

        $("#txtEmail").keyup(function(){
            var email=$("#txtEmail").val();
            var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
            if(!re.test(email)){
                $("#lblMessage").css("color", "red").text(email + " is not valid email");
                check = 3;
            }
            else{
                 $("#lblMessage").css("color", "green").text(email + " is  valid email");
            }
        });

        $("#frmRegistration").submit(function (event) {
            if (check == 1) {
                return true;
            }
            else if(check == 2) {
                event.preventDefault();
                swal("Warning!", "Username already exists !");
                return false;
            }
        });

        // Password Checker
        $('#txtPassword, #txtConfirmPassword').on('keyup', function () {
            if ($('#txtPassword').val() == $('#txtConfirmPassword').val()) {
                $('#lblMessage').html('Password and Retype password matched').css('color', 'green');
            } else{
                $('#lblMessage').html('Password and Retype password do not match').css('color', 'red');
            }
        });
    </script>
@show
</html>

