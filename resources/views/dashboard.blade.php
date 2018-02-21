@extends('layouts.app')
@section('content')
@if(Auth::user()->name == 'admin')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All labourers</div>

                <div class="panel-body">
                    
                <a href="labs/create" class="btn btn-primary">Insert Labour Data</a>
                <h3>Labourers:</h3>
                
                @if(count($labs)>0)
                <table class="table table-striped">
                 <tr>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                 </tr>       

                  @foreach($labs as $lab)
                  <tr>
                    <td>{{$lab->name}}</td>
                    <td><a href="/labs/{{$lab->id}}/edit" class="btn btn-default">edit labour data</a></td>
                    <td>
                    
                   {!!Form::open(['action'=>['labController@destroy',$lab->id],'method'=>'POST','class'=>'pull-right'])!!}
        
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

                   {!!Form::close()!!}
    
                    
                    </td>
                 </tr>
                  @endforeach
                
                </table>
              
                @else
                   <p> You have inserted no Labour records.</p>
                             
                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endif


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                <a href="posts/create" class="btn btn-primary">Create a Review Post</a>
                <h3>Your Posts</h3>
                
                @if(count($posts)>0)
                <table class="table table-striped">
                 <tr>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                 </tr>       

                  @foreach($posts as $post)
                  <tr>
                    <td>{{$post->title}}</td>
                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">edit</a></td>
                    <td>
                    
                   {!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
        
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

                   {!!Form::close()!!}
    
                    
                    </td>
                 </tr>
                  @endforeach
                
                </table>
              
                @else
                   <p> You have no posts.</p>
                             
                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
