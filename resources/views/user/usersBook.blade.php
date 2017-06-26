@extends('layouts.app')
@section('title', 'Create New user')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('user.create') }}"> Create New user</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {!! Form::open(array('route' => 'postUsersBooks','method'=>'POST')) !!}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>User</strong>
            {!! Form::select('user_number', [''=>'--Select--'] + $users, null, ['class'=>'form-control', 'id'=>'ddlUser']) !!}
        </div>
    </div>

    <table  class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tblBooks">
        </tbody>
    </table>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
    </div>
    {!! Form::close() !!}

@endsection

@section('script') @parent
<script type="text/javascript">

    // Loading book Data with the change of user
    $("#ddlUser").change(function(){
        var user_number = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: "{{ route('getUsersBooks') }}",
            method: 'POST',
            data: {user_number:user_number, _token:token},          
            success: function(data) {
                console.log(data);
                var row = [];
                $.each(data.cntBooksUsers, function(i, cntBooksUser) {
                    row.push("<tr>");
                    row.push("<td>" + (i + 1) + "</td>");          
                    row.push("<td>" + cntBooksUser.name + "</td>");
                    row.push("<td> <label class='input-toggle'> <input type='checkbox' name='result[" + cntBooksUser.book_number + "]'" + ( cntBooksUser.user_number == null ? '' : 'checked') + " />  <span></span> </label> </td>");
                    row.push("</tr>");
                });
                $('#tblBooks').html(row.join(""));
            }
        });
    });
</script>
@stop