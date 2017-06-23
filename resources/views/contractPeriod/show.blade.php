@extends('layouts.app')
@section('title', 'Show Contract Period')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Contract Period</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contractPeriod.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $contractPeriod->contract_period_name }}
            </div>
        </div>

    </div>

@endsection