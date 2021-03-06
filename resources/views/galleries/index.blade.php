@extends('layouts.main')

@section('title', '')

@section('content')
    <a href="{{ route('galleries.create') }}">Create New Gallery</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <td>Name</td>
            <td>Slug</td>
            <td>Cover Image</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        </thead>
        <tbody>
        @if($galleries->isEmpty())
            <tr>
                <td colspan="5" align="center">There are no galleries</td>
            </tr>
        @else
            @foreach($galleries as $gallery)
        <tr>
            <td>{{ $gallery->name }}</td>
            <td>{{ $gallery->slug }}</td>
            <td>
                {{ Html::image($gallery->cover_image, '', array('class'=>'img-responsive', 'width'=>'200px')) }}
            </td>
            <td>
                <a href="{{ route('galleries.edit', $gallery->id) }}">Edit</a>
            </td>
            <td>
                <a href="{{ route('galleries.confirm', $gallery->id) }}">Delete</a>
            </td>
        </tr>
            @endforeach
         @endif
        </tbody>
    </table>
@endsection