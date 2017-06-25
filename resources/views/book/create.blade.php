@extends('layouts.app')
@section('title', 'Create New book')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New book</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('book.index') }}"> Back</a>
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

    {!! Form::open(array('route' => 'book.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Subject</strong> 
                {!! Form::select('subject_number', [''=>'--- Select ---'] + $subjects, null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Grade</strong> 
                {!! Form::select('grade_number', [''=>'--- Select ---'] + $grades, null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Book Url</strong>
                {!! Form::text('book_url', null, array('placeholder' => 'Book Url','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Vertical Index</strong>
                {!! Form::text('vertical_index', null, array('placeholder' => 'Vertical Index','class' => 'form-control', 'onkeypress'=>'return numberValidate(event);')) !!}
            </div>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{Form::label('image_pass', 'Image Pass', ['class' => 'control-label'])}}
                {{Form::file('image_pass')}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
        </div>

    </div>
    {!! Form::close() !!}

@endsection

