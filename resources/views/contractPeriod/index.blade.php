@extends('layouts.app')
@section('title', 'Create New Contract Period')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Contract Periods</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('contractPeriod.create') }}"> Create New Contract Period</a>
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
    @foreach ($contractPeriods as $key => $contractPeriod)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $contractPeriod->contract_period_name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('contractPeriod.show',$contractPeriod->contract_period_number) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('contractPeriod.edit',$contractPeriod->contract_period_number) }}">Edit</a>

            {!! Form::open(['route' => ['contractPeriod.destroy', $contractPeriod->contract_period_number], 'method' => 'DELETE','class'=>'frmDelete','style'=>'display:inline']) !!}
                <button class="btn btn-danger delete-btn">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $contractPeriods->render() !!}

@endsection