@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Surveys</h1>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary">Create New Survey</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Questions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surveys as $survey)
                <tr>
                    <td>{{ $survey->name }}</td>
                    <td>
                        <ul>
                            @foreach($survey->questions as $question)
                                <li>
                                    <strong>{{ $question->content }}</strong> ({{ $question->type }})
                                    @if($question->rules)
                                        <br>Rules: {{ implode(', ', $question->rules) }}
                                    @endif
                                    @if($question->options)
                                        <br>Options: {{ implode(', ', $question->options) }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('surveys.view', $survey->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('surveys.entry', $survey->id) }}" class="btn btn-info">Fill</a>
                        <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
