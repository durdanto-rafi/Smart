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

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($users as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('user.show',$user->user_number) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('user.edit',$user->user_number) }}">Edit</a>

            {!! Form::open(['route' => ['user.destroy', $user->user_number], 'method' => 'DELETE','class'=>'frmDelete','style'=>'display:inline']) !!}
                <button class="btn btn-danger delete-btn">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $users->render() !!}

@endsection