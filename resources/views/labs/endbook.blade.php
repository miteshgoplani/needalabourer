@extends('layouts.app')

@section('content')

<head>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
</head>
<?php $temp=$lab->type;?>
             
<div><img class="thumb" align="right" style="width:20%" src="/profile_images/{{$lab->profile_image}}">
<div>   
<h2><small>Please enter Review/Feedback for Service with:</small><b> {{$lab->name}}</h2></b>
<h2><h1><small><small>Booking for:</small></small>@if($temp == 00)
            Carpenter
             @elseif($temp == 01)
             Electrician
             @elseif($temp == 10)
             Plumber
             @else
             Construction Worker
             @endif</h2></h1>   
</div>

</div><br><br><br><br><br><br><br><br><br>

{!! Form::open(['action' => ['PostController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    {{--  It is a rule that whenever we submit a file through a form then we have to add a attribute called enc-type
    and set that to multipart/form-data  --}}
    
    <div class="form-group">
    <label for="input-1" class="control-label">Please Give a rating for Service     :</label>
    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">
    </div>
     
    <div class="form-group">
    <p hidden>{{form::text('labid',$lab->id,['id' => 'labid', 'class' => 'form-control'])}}
    </p>
    </div>

    <div class="form-group">
    {{form::label('title','Review Post Title')}}
    {{form::text('title','',['placeholder' => 'Title','class' => 'form-control'])}} 
    {{--  title, first word is a refer variable to give reference   --}}
    </div>

    <div class="form-group">
    {{form::label('body','Additional Details/reasons about the Service:')}}
    {{form::textarea('body','',['id' => 'article-ckeditor', 'class' => 'form-control','placeholder' => 'Body Text'])}}
    </div> 

    <div class="form-group">
    {{form::label('amount','Please Enter Amount paid to Labourer for Verification:')}}
    {{form::text('amount','',['placeholder' => 'amount in ₹','class' => 'form-control'])}} 
    {{--  title, first word is a refer variable to give reference   --}}
    </div>

    <div class="form-group">
    {{form::label('image','Upload a supporting image to your review')}}
    {{Form::file('cover_image')}}
    {{--  the above line is written to get a file upload button in the edit view  --}}
    </div>




    <br><br>
    {{form::submit('Submit Review',['class' => 'btn btn-primary' ]) }}
    


{!! Form::close() !!}

@endsection   