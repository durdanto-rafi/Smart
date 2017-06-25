@extends('layouts.app')
@section('title', 'Create New book')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Books</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('book.create') }}"> Create New book</a>
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
    @foreach ($books as $key => $book)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $book->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('book.show',$book->book_number) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('book.edit',$book->book_number) }}">Edit</a>

            {!! Form::open(['route' => ['book.destroy', $book->book_number], 'method' => 'DELETE','class'=>'frmDelete','style'=>'display:inline']) !!}
                <button class="btn btn-danger delete-btn">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $books->render() !!}

@endsection