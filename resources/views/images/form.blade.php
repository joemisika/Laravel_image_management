@extends('layouts.main')

@section('title', $image->exists ? 'Update image':'Create a New Image')

@section('content')

    {!! Form::model($image, [
        'class'=>'form-horizontal',
        'method'=> $image->exists ? 'put' : 'post',
        'route'=>$image->exists ? ['images.update', $image->id]: ['images.store'], 'files'=>true ])
    !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit($image->exists ? 'Save Image' : 'Create Image', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection