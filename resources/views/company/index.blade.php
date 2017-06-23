@extends('layouts.app')
@section('title', 'Create New Company')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Companies</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('company.create') }}"> Create New Company</a>
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
    @foreach ($companies as $key => $company)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $company->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('company.show',$company->company_number) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('company.edit',$company->company_number) }}">Edit</a>

            {!! Form::open(['route' => ['company.destroy', $company->company_number], 'method' => 'DELETE','class'=>'frmDelete','style'=>'display:inline']) !!}
                <button class="btn btn-danger delete-btn">Delete</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $companies->render() !!}

@endsection