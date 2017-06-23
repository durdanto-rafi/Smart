@extends('layouts.app')
@section('title', 'Create New subject')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>subjects</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('subject.create') }}"> Create New subject</a>
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
    @foreach ($subjects as $key => $subject)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $subject->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('subject.show',$subject->subject_number) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('subject.edit',$subject->subject_number) }}">Edit</a>

            {!! Form::open(['route' => ['subject.destroy', $subject->subject_number], 'method' => 'DELETE','class'=>'frmDelete','style'=>'display:inline']) !!}
                <button class="btn btn-danger delete-btn">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $subjects->render() !!}

@endsection