@extends('layouts.app')

@section('content')

<h1>All Labourers</h1>
<!DOCTYPE HTML>
<HTML>
@if(count($labs)>0)

     @foreach($labs as $lab) 
     <div class="well">
     {{--  some bootstrap stuff  --}}
         <div class="row">
<b><u><center> 
             <?php $temp=$lab->type; ?>
             @if($temp == 00)
             <h1>Carpenter</h1>
             @elseif($temp == 01)
             <h1>Electrician</h1>
             @elseif($temp == 10)
             <h1>Plumber</h1>
             @else
             <h1>Construction Worker</h1>
             @endif
</center></b></u>
             <div class="col-mod-2 col-sm-2">
             <img class="thumb" style="width:100%" src="/profile_images/{{$lab->profile_image}}">
             
              </div> 
             <div class="col-mod-8 col-sm-8">
                <h3><a href="/labs/{{$lab->id}}">{{$lab->name}}</a></h3>
                <h4>{{$lab->zone}}</h4>
                   <small>Booked at:  {{$lab->modified_at}} by {{$lab->user['name']}}</small>
     
             </div>

             <div class="col-mod-6 col-sm-2">
                 <?php $temp=$lab->profile_image; ?>
             
             <img class="thumb" style="width:100%" src="/proof_images/{{$lab->proof_image}}">
            </div>
            <?php
            $stat=$lab->status;
            ?>
             @if($stat == NULL)
             <a href="/labs/{{$lab->id}}/book"><button type="button" class="btn btn-primary btn-block active">Book Labourer</button></a>
             @else
             <button type="button" class="btn btn-primary btn-block disabled">Book Labourer</button>
            @endif

             
              
            
         </div>
     
     
     </div>
     @endforeach
     {{$labs->links()}}  

@else

<p>No Labourers Registered</p>

@endif

@endsection
<html>