<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Metric;
use App\Models\MetricProject;

class MetricProjectController extends Controller
{
    public function index($id)
    {
        $project = Project::findOrFail($id);
        $metricProjects = $project->metricProjects()->whereNull('report_month')->whereNull('report_year')->get();
        return view('metric_projects.index', compact('project', 'metricProjects'));
    }

    public function create($id)
    {
        $project = Project::findOrFail($id);
        $metrics = Metric::all();
        return view('metric_projects.create', compact('project', 'metrics'));
    }

    public function store(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $request->validate([
            'metric_id' => 'required|exists:metrics,id',
        ]);

        $metricProject = new MetricProject($request->all());
        $metricProject->project_id = $project->id;
        $metricProject->save();

        return redirect()->route('metric-projects.index', $project->id)->with('success', 'Metric project created successfully.');
    }

    public function addReport($projectId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::findOrFail($metricProjectId);
        return view('metric_projects.add_report', compact('project', 'metricProject'));
    }

    public function storeReport(Request $request, $projectId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::findOrFail($metricProjectId);

        $request->validate([
            'value' => 'nullable|string',
            'report_month' => 'required|integer',
            'report_year' => 'required|integer',
        ]);

        $report = new MetricProject($request->all());
        $report->project_id = $project->id;
        $report->metric_id = $metricProject->metric_id;
        $report->metric_project_id = $metricProject->id;
        $report->save();

        return redirect()->route('metric-projects.index', $project->id)->with('success', 'Metric report added successfully.');
    }
}
