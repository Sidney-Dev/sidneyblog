@extends('layouts.admin')
@section('content')

@include('includes.tinyeditor')
<h1>New Post</h1>

{!! Form::model($post, ['method' => 'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}

<div class="form-group">
     {!! Form::label('title', 'Title:') !!}
     {!! Form::text('title', null, ['class'=>'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories, null, ['class'=>'form-control'])!!}
</div>


<div class="form-group">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::file('photo', null,['class'=>'form-control'])!!}
 </div>


<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control'])!!}
</div>

 <div class="form-group">
    {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
 </div>

{!! Form::close() !!}

@stop