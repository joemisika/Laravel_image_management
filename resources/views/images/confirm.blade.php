@extends('layouts.main')

@section('title', 'Delete '.$image->name)

@section('content')
	{!! Form::open(['method' => 'delete', 'route' => ['images.destroy', $image->id]]) !!}
		<div class="alert alert-danger">
			<strong>Warning!</strong> You are about to delete {{ $image->name }}. This action cannot be undone. Are you sure you want to continue?
		</div>
		{!! Form::submit('Yes, delete this Image'), ['class' => 'btn btn-danger'] !!}

		<a href="{{ route('galleries.index') }}" class="btn btn-success">
			<strong>No, get me out of here!</strong>
		</a>

	{!! Form::close() !!}
@stop