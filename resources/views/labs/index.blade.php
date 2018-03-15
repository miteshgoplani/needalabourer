@extends('layouts.app')

@section('content')

<h1>All Labourers</h1>
<!DOCTYPE HTML>
<HTML>

<head>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
</head>



@if(count($labs)>0)

     @foreach($labs as $lab) 
     <div class="well">
     {{--  some bootstrap stuff  --}}
         <div class="row">
         <?php $rating=$lab->rating; ?>
<h3><u><left>Rating:</u><b>   {{$rating}}</b>   Stars</left></h3>
<b><u><center> 
             <?php $temp=$lab->type;?>
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
             @if(Auth::user()->name=='admin')
             <div class="col-mod-6 col-sm-2">
                 
             
             <img class="thumb" style="width:100%" src="/proof_images/{{$lab->proof_image}}">
            </div>@endif
            <?php
            $stat=$lab->status;
            $check=($lab->user_id == Auth::user()->id)
            ?>
             
             <!-- <label for="input-1" class="control-label">Labour Rating:</label>
             <input id="input-1" name="input-1" class="rating rating-loading" data-min="3" data-max="3" data-step="0.1" value="3"> -->
             
             @if($stat == NULL) 
             <a href="/labs/{{$lab->id}}/book"><button type="button" class="btn btn-primary btn-block active">Book Labourer</button></a>
             @elseif($check)
             <a href="/labs/{{$lab->id}}/endBooking"><button type="button" class="btn btn-primary btn-block active">End Booking</button></a>
             @else
             <button type="button" class="btn btn-primary btn-block disabled">End Booking</button>
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