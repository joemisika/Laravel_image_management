@extends('layouts.main')

@section('title', '')

@section('content')

   {!! Form::model($gallery, ['class'=>'form-horizontal', 'method'=> $gallery->exists ? 'put' : 'post', 'route'=>$gallery->exists ? ['galleries.update', $gallery->id]: ['galleries.store'], 'files'=>true ])!!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) !!}
    </div>

    @if($gallery->cover_image)
       {{ Html::image($gallery->cover_image, '', array('class'=>'img-responsive', 'width'=>'200px')) }}
    @endif

    <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'description']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit($gallery->exists ? 'Save Gallery' : 'Create Gallery', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}





@endsection