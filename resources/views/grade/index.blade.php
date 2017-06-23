@extends('layouts.app')
@section('title', 'Create New grade')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>grades</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('grade.create') }}"> Create New grade</a>
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
    @foreach ($grades as $key => $grade)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $grade->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('grade.show',$grade->grade_number) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('grade.edit',$grade->grade_number) }}">Edit</a>

            {!! Form::open(['route' => ['grade.destroy', $grade->grade_number], 'method' => 'DELETE','class'=>'frmDelete','style'=>'display:inline']) !!}
                <button class="btn btn-danger delete-btn">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $grades->render() !!}

@endsection