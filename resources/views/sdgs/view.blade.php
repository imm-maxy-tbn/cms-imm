@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit SDGs</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $sdg->name }}" readonly>
                    <label for="order">Order:</label>
                    <input type="number" class="form-control" id="order" name="order" value="{{ $sdg->order }}" readonly>
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $sdg->description }}" readonly>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('sdgs.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
@endsection
