@extends('layouts.app')

@section('content')

<h1>Posts</h1>
<!DOCTYPE HTML>
<HTML>
@if(count($posts)>0)

     @foreach($posts as $post) 
     <div class="well">
     {{--  some bootstrap stuff  --}}
         <div class="row">
             <div class="col-mod-4 col-sm-4">
                 <?php $temp=$post->cover_image; ?>
             {{--  <img class="thumb" style="width:100%" src="{{ URL::to('/Golden-Gate-Bridge_1516709328.jpg')}}">   --}}
           {{--  <img class="thumb" style="width:100%" src="{{ URL::to('/cover_images/')}}">   --}}
             <img class="thumb" style="width:100%" src="/cover_images/{{$post->cover_image}}">
             {{--  {{$post->cover_image}} will fetch the image from database  --}}
              </div> 
             <div class="col-mod-8 col-sm-8">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                   <small>Written at:  {{$post->created_at}} by {{$post->user['name']}}</small>
     
             </div>

         </div>
     
     
     </div>
     @endforeach
     {{$posts->links()}}  

@else

<p>No post found</p>

@endif

@endsection
<html>