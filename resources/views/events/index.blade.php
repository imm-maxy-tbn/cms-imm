@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <h1>Events</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Topic</th>
                    <th>Image</th>
                    <th>Location</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Deadline</th>
                    <th>Registered Users</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->topic }}</td>
                        <td>
                            @if ($event->img)
                                <img src="{{ asset('images/' . $event->img) }}" height="50" width="50" alt="Event Image">
                            @else
                                <p>No image</p>
                            @endif
                        </td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->start }}</td>
                        <td>{{ $event->end }}</td>
                        <td>{{ $event->deadline }}</td>
                        <td>{{ $event->users_count }}</td>
                        <td>
                            <a href="{{ route('events.view', $event) }}" class="btn btn-info">View</a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
