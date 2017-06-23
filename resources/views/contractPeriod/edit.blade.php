@extends('layouts.app')
@section('title', 'Create New Contract Period')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit New Contract Period</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contractPeriod.index') }}"> Back</a>
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

    {!! Form::model($contractPeriod, ['method' => 'PATCH','route' => ['contractPeriod.update', $contractPeriod->contract_period_number]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('contract_period_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
             {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
        </div>

    </div>
    {!! Form::close() !!}

@endsection
