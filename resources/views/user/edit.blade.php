@extends('layouts.app')
@section('title', 'Create New User')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit New user</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
            </div>
        </div>
    </div>

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

    {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->user_number]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name</strong> 
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="input-toggle">
                    {{ Form::checkbox('flg_multi_login', 1, null ) }}
                <span></span> </label> Multi Login
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company</strong> 
                {!! Form::select('company_number', $companies, $user->company_number, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username</strong> 
                {!! Form::text('id', null, array('placeholder' => 'ID', 'class' => 'form-control', 'id'=>'txtUsername')) !!}
            </div>
        </div>

        <div class="col-xs-11 col-sm-11 col-md-11">
            <div class="form-group">
                <strong>Password</strong> 
                {{ Form::text('password', null, array('placeholder'=>'Password', 'class'=>'form-control', 'id'=>'txtPassword', 'onkeypress'=>'return false;')) }}
            </div>
        </div>

        <div class="col-xs-1 col-sm-1 col-md-1">
            <div class="form-group">
                <strong> &nbsp;</strong> 
                {{ Form::button('New', array('class' => 'btn btn-primary', 'id'=>'btnNewPassword')) }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="input-toggle">
                    {{ Form::checkbox('enable', 1, null ) }}
                <span></span> </label> Enable
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Contract Start Date</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('contract_start_day', null, array('placeholder' => 'Contract Start Date', 'class' => 'form-control pull-right datepicker', 'id'=>'txtStartDate')) !!}
            </div>
            <!-- /.input group -->
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label>Contract Period Date</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('contract_period_day', null, array('placeholder' => 'Contract Period Date', 'class' => 'form-control pull-right datepicker', 'id'=>'txtPeriodDate')) !!}
            </div>
            <!-- /.input group -->
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label id="lblMessage"/> 
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('script') @parent
<script type="text/javascript">
    //Date picker
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    // Password Checker
    $('#txtPassword, #txtConfirmPassword').on('keyup', function () {
        if ($('#txtPassword').val().length < 6 || $('#txtConfirmPassword').val().length < 6){
            $('#lblMessage').html('Password need to be atleast 6 digit').css('color', 'red');
        }else if ($('#txtPassword').val() == $('#txtConfirmPassword').val()) {
            $('#lblMessage').html('Password and Retype password matched').css('color', 'green');
        } else{
            $('#lblMessage').html('Password and Retype password do not match').css('color', 'red');
        }
    });

    // ID Checker
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

    // Generate password
    $("#btnNewPassword").click(function(e) {
        e.preventDefault();
        var token = $("input[name='_token']").val();
        $.ajax({
            type:"post",
            dataType: "json",
            url :"{{ route('generatePassword') }}",
            data: { 
                _token:token
            },
            success: function(result) {
                document.getElementById('txtPassword').value = result.password;
            },
            error: function(result) {
                alert('error');
            }
        });
    });
</script>
@stop