<!-- resources/views/tags/index.blade.php -->

@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Tag List</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create New Tag</a>
    @if ($tags->isEmpty())
    <p>No tags found.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->nama }}</td>
                <td>
                    @if ($tag->img)<img src="{{ asset($tag->img) }}" alt="{{ $tag->nama }}" style="max-width: 100px;">
                    @else
                    No images
                    @endif
                </td>
                <td>
                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
