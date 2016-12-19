@extends('layouts.main')

@section('title', $image->exists ? 'Update image':'Create a New Image')

@section('content')

   {!! Form::model($image, ['class'=>'form-horizontal','method'=> $image->exists ? 'put' : 'post','route'=>$image->exists ? ['images.update', $image->id]: ['images.store'], 'files'=>true ])!!}

    	<div class="form-group">
        	{!! Form::label('title', 'Title:') !!}
      	{!! Form::text('title', null, ['class'=>'form-control', 'id'=>'title']) !!}
    	</div>
    	<div class="form-group">
        {{-- <div class="col-md-3"> --}}
            {!! Form::label('gallery_id', 'Galleries') !!}
            {!! Form::select('gallery_id', $galleries, null, ['class' => 'form-control']) !!}
        {{-- </div> --}}
    </div>

		@if($image->image)
       	{{ Html::image($image->image, '', array('class'=>'img-responsive', 'height'=>'250px', 'width'=>'250px')) }}
    	@endif
		<div class="form-group">
      	{{ Form::file('image') }}
    	</div>

		<div class="form-group">
        	{!! Form::label('image_credit', 'Image Credit:') !!}
        	{!! Form::textarea('image_credit', null, ['class'=>'form-control', 'id'=>'image_credit']) !!}
    	</div>

    	<div class="form-group">
        	{!! Form::label('description', 'Description:') !!}
        	{!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'description']) !!}
    	</div>

    	<div class="form-group">
      	{!! Form::submit($image->exists ? 'Save Image' : 'Create Image', ['class'=>'btn btn-primary']) !!}
    	</div>

   {!! Form::close() !!}
@endsection