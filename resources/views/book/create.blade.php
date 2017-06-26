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

    <form action="{{ route('book.store') }}" enctype="multipart/form-data" method="POST">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Image:</label>
                    <input type="file" name="image" class="control-label">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <button class="btn btn-success upload-image" type="submit">Upload Image</button>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <div class="form-group">
                    {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                </div>
            </div>


        </div>
    </form>

@endsection

@section('script') @parent
<script type="text/javascript">
    $("body").on("click",".upload-image",function(e){
        $(this).parents("form").ajaxForm(options);
    });

    var options = { 
        complete: function(response) {
            if($.isEmptyObject(response.responseJSON.error)){
                $("input[name='title']").val('');
                alert('Image Upload Successfully.');
            }else{
                printErrorMsg(response.responseJSON.error);
            }
        }
    };

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }
</script>
@stop