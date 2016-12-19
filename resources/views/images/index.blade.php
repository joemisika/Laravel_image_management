@extends('layouts.main')

@section('title', '')

@section('content')
    <a href="{{ route('images.create') }}">Create New Image</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <td>Name</td>
            {{-- <td>Slug</td> --}}
            <td>Image</td>
            <td>Gallery</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        </thead>
        <tbody>
        @if($images->isEmpty())
            <tr>
                <td colspan="5" align="center">There are no images</td>
            </tr>
        @else
            @foreach($images as $image)
        <tr>
            <td>{{ $image->title }}</td>
            {{-- <td>{{ $image->slug }}</td> --}}
            <td>
                {{ Html::image($image->image, '', array('class'=>'img-responsive', 'width'=>'200px')) }}
            </td>
            <td>{{ $image->gallery->name }}</td>
            <td>
                <a href="{{ route('images.edit', $image->id) }}">Edit</a>
            </td>
            <td>
                <a href="{{ route('images.confirm', $image->id) }}">Delete</a>
            </td>
        </tr>
            @endforeach
         @endif
        </tbody>
    </table>
@endsection