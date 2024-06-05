@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <h1>Metric Projects for Project: {{ $project->nama }}</h1>

        <h2>Initial Metrics</h2>
        @if ($initialMetricProjects->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Metric</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($initialMetricProjects as $metricProject)
                        <tr>
                            <td>{{ $metricProject->metric->name }}</td>
                            <td>{{ $metricProject->value }}</td>
                            <td>
                                <a href="{{ route('metric-projects.edit', [$project->id, $metricProject->id]) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('metric-projects.addReport', [$project->id, $metricProject->id]) }}"
                                    class="btn btn-primary btn-sm">Add Report</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No initial metrics available.</p>
        @endif

        <h2>Reports</h2>
        @if ($reportMetricProjects->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Metric</th>
                        <th>Value</th>
                        <th>Report Month</th>
                        <th>Report Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportMetricProjects as $report)
    <tr>
        <!-- Metrics with report month and year -->
        <td>{{ $report->metric->name }}</td>
        <td>{{ $report->value }}</td>
        <td>{{ $report->report_month }}</td>
        <td>{{ $report->report_year }}</td>
        <td>
            <!-- Edit button -->
            <a href="{{ route('metric-projects.edit', [$project->id, $report->id]) }}"
                class="btn btn-warning btn-sm">Edit</a>
            <!-- Delete button -->
            <form action="{{ route('metric-projects.destroy', [$project->id, $report->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this metric project?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

                </tbody>
            </table>
        @else
            <p>No reports available.</p>
        @endif
    </div>
@endsection
