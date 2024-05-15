@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">View Page</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form>
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $page->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" id="content" name="content" rows="4" readonly>{{ $page->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="img">Images:</label>
                    <div id="img">
                        <img src="{{ asset('images/' . $page->img) }}" height="50" width="50">
                        <p>{{ basename($page->img) }}</p>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('pages.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
@endsection