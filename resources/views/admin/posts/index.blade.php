@extends('layouts.admin')

@section('content')

<h1>All Posts</h1>

<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Thumbnail</th>
        <th>Category</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($posts as $post)
	      <tr>
	      	<td>{{$post->id}}</td>
	        <td>{{$post->title}}</td>
	        <td><img height="50" src="{{$post->photo ? $post->photo : 'http://placehold.it/400x400' }} " alt="{{$post->title}}"></td>

	        <td>{{$post->category->name}}</td>

	        <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a></td>
	        <td>
	        	{!! Form::model($post, ['method' => 'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'files'=>true]) !!}
	        
	        		{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
	        
	        	{!! Form::close() !!}
	        </td>
	      </tr>
      	@endforeach
    </tbody>
</table>

@stop