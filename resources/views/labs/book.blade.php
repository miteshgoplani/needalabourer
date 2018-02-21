@extends('layouts.app')

@section('content')

<h1>Submit Booking Details</h1>

{!! Form::open(['action' => ['labController@update',$lab->id], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    {{--  It is a rule that whenever we submit a file through a form then we have to add a attribute called enc-type
    and set that to multipart/form-data  --}}




<div class="form-group">
    {{form::label('address','Enter Booking Address')}}
    {{form::textarea('address','',['placeholder' => 'ENTER ADDRESS','class' => 'form-control'])}} 

    
    
    <br><br>
    
    <div class="form-group">
    {{form::label('contact','Contact No. for Booking')}}
    {{form::text('contact','',['placeholder' => 'Contact No.','class' => 'form-control'])}} 
    {{--  title, first word is a refer variable to give reference   --}}
    </div>
<br><br>
    <div class="form-group">
    {{form::label('date','Date of Booking  (in dd/mm/yyyy format)')}}
    {{form::text('date','',['id' => 'article-ckeditor', 'class' => 'form-control','placeholder' => 'dd/mm/yyyy'])}}
    </div> 

    {{form::hidden('_method','PUT')}}
    
    {{form::submit('Confirm Booking',['class' => 'btn btn-primary' ]) }}
    


{!! Form::close() !!}

@endsection   