@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Add New Company Outcome</h1>

    <form action="{{ route('company-outcome.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_biaya">Jumlah Biaya</label>
            <input type="text" class="form-control" id="jumlah_biaya" name="jumlah_biaya" value="{{ old('jumlah_biaya') }}">
            @error('jumlah_biaya')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="bukti">Bukti</label>
            <input type="text" class="form-control" id="bukti" name="bukti" value="{{ old('bukti') }}">
            @error('bukti')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="project_id">Project</label>
            <select class="form-control" id="project_id" name="project_id">
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->nama }}</option>
                @endforeach
            </select>
            @error('project_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
