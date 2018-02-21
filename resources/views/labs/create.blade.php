@extends('layouts.app')

@section('content')

<h1>Labour Details</h1>

{!! Form::open(['action' => 'labController@store', 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    {{--  It is a rule that whenever we submit a file through a form then we have to add a attribute called enc-type
    and set that to multipart/form-data  --}}



<div class="form-group">
  <label for="type">Select Labour Type:</label>
  <select class="form-submit" id="type" name="type">
  <option value="" class="hidden"></option>
    <option value="00">Carpenter</option>
    <option value="01">Electrician</option>
    <option value="10">Plumber</option>
    <option value="11">Construction-Site</option>
  </select>
</div>
    

<!-- <form class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">name:</label>
    <div class="col-sm-10">
    {{form::text('name','',['placeholder' => 'name','class' => 'form-control-static'])}}      
      </div>
  </div>
</form> -->

<br>
<div class="form-group">
    {{form::label('name','NAME')}}
    {{form::text('name','',['placeholder' => 'Name','class' => 'form-control'])}} 

<br><br>
    <div class="form-group">
    <label class="control-label col-sm-5" for="profile_image">Upload Profile Image</label>
        {{Form::file('profile_image')}}
        {{--  the above line is written to get a file upload button in the create view  --}}
    </div><br>
    <div class="form group">
    <label class="control-label col-sm-5" for="proof_image">Upload Proof Image</label>
        {{Form::file('proof_image')}}
        {{--  the above line is written to get a file upload button in the create view  --}}
    </div>

<!-- </div>
<div class="container">
<form class="form-inline">
    <div class="form-group">
      <label for="focusedInput">Focused</label>
      <input class="form-control" id="focusedInput" type="text">
    </div>
    <div class="form-group">
      <label for="inputPassword">Disabled</label>
      <input class="form-control" id="disabledInput" type="text" disabled>
    </div>
    <div class="form-group has-success has-feedback">
      <label for="inputSuccess2">Input with success</label>
      <input type="text" class="form-control" id="inputSuccess2">
      <span class="glyphicon glyphicon-ok form-control-feedback"></span>
    </div>
</form>
</div> -->
<br><br><br>
    <div class="form-group">
    <label for="zone">Select Zone:</label>
    <select class="form-submit" id="zone" name="zone">
        <option value="Mumbai">Mumbai</option>
        <option value="Navi Mumbai">Navi Mumbai</option>
        <option value="Thane">Thane</option>
        <option value="Other">Other</option>
    </select>
    </div>
    
    
    <br><br>
    
    <div class="form-group">
    {{form::label('aadhar','Aadhar No.')}}
    {{form::text('aadhar','',['placeholder' => 'Aadhar No.','class' => 'form-control'])}} 
    {{--  title, first word is a refer variable to give reference   --}}
    </div>
<br><br>
    <div class="form-group">
    {{form::label('description','Additional Details')}}
    {{form::text('description','',['id' => 'article-ckeditor', 'class' => 'form-control','placeholder' => 'Additional Details'])}}
    </div> 

    
    
    {{form::submit('Add Labourer',['class' => 'btn btn-primary' ]) }}
    


{!! Form::close() !!}

@endsection   