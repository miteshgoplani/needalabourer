@extends('layouts.app')

@section('content')

<h1>Create Post</h1>

{!! Form::open(['action' => 'PostController@store', 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    {{--  It is a rule that whenever we submit a file through a form then we have to add a attribute called enc-type
    and set that to multipart/form-data  --}}
    <div class="form-group">

    {{form::label('title','TITLE')}}
    {{form::text('title','',['placeholder' => 'Title','class' => 'form-control'])}} 
    {{--  title, first word is a refer variable to give reference   --}}
    </div>

    <div class="form-group">
    {{form::label('body','BODY')}}
    {{form::textarea('body','',['id' => 'article-ckeditor', 'class' => 'form-control','placeholder' => 'Body Text'])}}
    </div> 

    <div class="form-group">
        {{Form::file('cover_image')}}
        {{--  the above line is written to get a file upload button in the create view  --}}
    </div>
    
    {{form::submit('Submit',['class' => 'btn btn-primary' ]) }}
    


{!! Form::close() !!}

@endsection   