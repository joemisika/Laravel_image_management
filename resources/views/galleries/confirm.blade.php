@extends('layouts.main')

@section('title', 'Delete '.$gallery->name)

@section('content')
	{!! Form::open(['method' => 'delete', 'route' => ['galleries.destroy']]) !!}
		<div class="alert alert-danger">
			<strong>Warning!</strong> You are about to delete {{ $gallery->name }}. This action cannot be undone. Are you sure you want to continue?
		</div>
		{!! Form::submit('Yes, delete this Gallery'), ['class' => 'btn btn-danger'] !!}

		<a href="{{ route('galleries.') }}" class="btn btn-success">
			<strong>No, get me out of here!</strong>
		</a>

	{!! Form::close() !!}
@stop