@extends('layouts.app')
@section('content')
<html>
<h1><b>{{Auth::user()->name}}'s</b> Profile:</h1>
<strong>User Id:</strong>&nbsp;
<?php
echo auth()->user()->id;
?>

<p><p><p>
<strong>User Name:</strong>&nbsp;
<?php
echo auth()->user()->name;
?>

<strong><p><p><p>User Email:</strong>&nbsp;
<?php
echo auth()->user()->email;
?>

</html>
@endsection    
