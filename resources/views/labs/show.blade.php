@extends('layouts.app')

@section('content')

<a href="/labs" class="btn btn-default">Go back</a>
<h1>Labour type :
<b> 
             <?php $temp=$lab->type; ?>
             @if($temp == 00)
             Carpenter
             @elseif($temp == 01)
             Electrician
             @elseif($temp == 10)
             Plumber
             @else
             Construction Worker
             @endif
</b><br></h1>
<h2>Name: {{$lab->name}}</h2><br>
<h4>profie image:</h4>
<h4 align="right">proof image:</h4>
<img  style="width:20%"  src="/profile_images/{{$lab->profile_image}}">
<img  style="width:20%" align="right" src="/proof_images/{{$lab->proof_image}}">
<br><br>
<div>

<strong><u><h5>Additional Details about the Worker:</h5></strong></u>
{!!$lab->description!!}; 
{{--  if we use this {{$lab->description}}; then it will not pass it as HTML, it will pass the text as it is 
and all the attributes made on the text will be shown as text; so to pass the html code we need to 
write as written above.   --}}


</div>

<hr>
<small>Booked at:   {{$lab->updated_at}}  by {{$lab->user['name']}}</small>
<hr>
@if(!Auth::guest())
{{--  if user is not Auth and is a guest then he wont be able to see the if block  --}}
@if(Auth::user()->name=='admin')
<a href="/labs/{{$lab->id}}/edit" class="btn btn-default">Edit</a>


{!!Form::open(['action'=>['labController@destroy',$lab->id],'method'=>'POST','class'=>'pull-right'])!!}
    
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

{!!Form::close()!!}
@endif
@endif 

@endsection