@extends('layouts.app')

@section('content')

<h1>Edit Post</h1>

{!! Form::open(['action'=>['PostController@update',$post->id],'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
{{--  we created an array using [] and passed it so that while updating it knows which post to update  --}}
    <div class="form-group">

    {{form::label('title','TITLE')}}
    {{form::text('title',$post->title,['placeholder' => 'Title','class' => 'form-control'])}} 
    {{--  title, first word is a refer variable to give reference   --}}
    </div>

    <div class="form-group">
    {{form::label('body','BODY')}}
    {{form::textarea('body',$post->body,['id' => 'article-ckeditor', 'class' => 'form-control','placeholder' => 'Body Text'])}}
    </div> 

        <div class="form-group">
        {{Form::file('cover_image')}}
        {{--  the above line is written to get a file upload button in the edit view  --}}
        </div>
    {{form::hidden('_method','PUT')}}
    {{--  in edit.blade.php we have method of form as POST which can be changed to GET/POST only but the type 
    of method required for edit is PUT which is possible in laravel by making a hidden request below the body  --}}
    
    {{form::submit('Submit',['class' => 'btn btn-primary' ]) }}
    


{!! Form::close() !!}

@endsection   