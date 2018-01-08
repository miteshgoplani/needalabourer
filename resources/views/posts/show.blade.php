@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go back</a>
<h1>{{$post->title}}</h1>
             <img  style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
<br><br>
<div>


{!!$post->body!!}; 
{{--  if we use this {{$post->body}}; then it will not pass it as HTML, it will pass the text as it is 
and all the attributes made on the text will be shown as text; so to pass the html code we need to 
write as written above.   --}}


</div>

<hr>
<small>Written at:   {{$post->created_at}}  by {{$post->user->name}}</small>
<hr>
@if(!Auth::guest())
{{--  if user is not Auth and is a guest then he wont be able to see the if block  --}}
@if(Auth::user()->id==$post->user_id)
<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>


{!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
    
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

{!!Form::close()!!}
@endif
@endif 

@endsection