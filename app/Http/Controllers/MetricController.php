<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    public function index()
    {
        $metrics = Metric::with('tags', 'indicators')->get();
        return view('metrics.index', compact('metrics'));
    }

    public function create()
    {
        // Load any data needed for the form (e.g., options for tags and indicators)
        return view('metrics.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validated();
        $metric = Metric::create($validatedData);

        $metric->tags()->attach($request->input('tag_ids'));
        $metric->indicators()->attach($request->input('indicator_ids'));

        return redirect()->route('metrics.index')->with('success', 'Metric created successfully');
    }

    public function show($id)
    {
        $metric = Metric::with('tags', 'indicators', 'relatedMetrics')->findOrFail($id);
        return view('metrics.show', compact('metric'));
    }

    public function edit($id)
    {
        $metric = Metric::with('tags', 'indicators')->findOrFail($id);
        // Load data needed for the form (e.g., available tags, indicators)
        return view('metrics.edit', compact('metric'));
    }

    public function update(Request $request, $id)
    {
        $metric = Metric::findOrFail($id);
        $metric->update($request->validated());

        $metric->tags()->sync($request->input('tag_ids', []));
        $metric->indicators()->sync($request->input('indicator_ids', []));

        return redirect()->route('metrics.index')->with('success', 'Metric updated successfully');
    }

    public function destroy($id)
    {
        Metric::destroy($id);
        return redirect()->route('metrics.index')->with('success', 'Metric deleted successfully');
    }
}
