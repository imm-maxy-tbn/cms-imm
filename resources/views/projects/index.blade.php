@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Project List</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create New Project</a>

    @if ($projects->isEmpty())
        <p>No projects found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Gambar Project</th>
                        <th>Nama Project</th>
                        <th>Deskripsi</th>
                        <th>Tujuan</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>URL Google Maps</th>
                        <th>Jumlah Dana Keseluruhan:</th>
                        <th>Tags</th>
                        <th>SDGs</th>
                        <th>Indicators</th>
                        <th>Metrics</th>
                        <th>Target Customers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $project->img) }}" height="75" width="auto">
                            </td>                            
                            <td>
                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $project->nama }}
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $project->deskripsi }}
                                </div>
                            </td>
                            <td>{{ $project->tujuan }}</td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>{{ $project->provinsi }}</td>
                            <td>{{ $project->kota }}</td>
                            <td>{{ $project->gmaps }}</td>
                            <td>{{ $project->jumlah_pendanaan }}</td>
                            <td>
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @foreach($project->tags as $tag)
                                        {{ $tag->nama }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @foreach($project->sdgs as $sdg)
                                        {{ $sdg->order }}. {{ $sdg->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @foreach($project->indicators as $indicator)
                                        {{ $indicator->order }}. {{ $indicator->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @foreach($project->metrics as $metric)
                                        ({{ $metric->code }}) {{ $metric->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @foreach($project->targetPelanggan as $target)
                                        {{ $target->status }} ({{ $target->rentang_usia }}){{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('projects.view', $project->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-info-circle" style="color: #ffffff;"></i>
                                </a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-pencil-alt" style="color: #ffffff;"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">
                                        <i class="fas fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
