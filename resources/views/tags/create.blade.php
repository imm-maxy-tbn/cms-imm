<!-- resources/views/pages/create.blade.php -->
@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Page') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create New Tag</h1>

    <!-- Form for creating a new page -->
    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="{{ route('tags.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Name:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" class="form-control-file" id="img" name="img" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Create Tag</button>
        </form>
        </div>
    </div>

</div>

@endsection
