@extends('layouts.app')
@section('content')
    <h1>{{$title}}</h1>
  <ul class="list group">
  <?php
  $link=array(
    'carpenter','plumber','electrician','construction'
  );  
    $i=0;
    ?>
     @if(count($services)> 0)
       @foreach($services as $service)
      <a href="<?php echo $link[$i] ?>"><li class="list-group-item">{{$service}}</li></a> 
      <?php $i++; ?>
       @endforeach

    @endif
</ul>
@endsection    
