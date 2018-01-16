@extends('layouts.app')
@section('content')
<div class="jumbotron text-center">
<h1>Welcome</h1>

<h2>{{$title}}</h2>
<p><a class="btn btn-primary btn-lg" href="/login" role="button">login</a>
<a class="btn btn-success btn-lg" href="/register" role="button">register</a>
</p>
@endsection 