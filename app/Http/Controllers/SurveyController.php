<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use MattDaneshvar\Survey\Models\Survey;
use MattDaneshvar\Survey\Models\Entry;
use App\Models\User;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        try {
            logger($request->all()); // Use Laravel's logger

            $request->validate([
                'name' => 'required|string|max:255',
                'settings.accept-guest-entries' => 'required',
                'settings.limit-per-participant' => 'required',
                'sections' => 'required|array',
                'sections.*.name' => 'required|string',
                'sections.*.questions' => 'required|array',
                'sections.*.questions.*.content' => 'required|string',
                'sections.*.questions.*.type' => 'required|string',
                'sections.*.questions.*.rules' => 'nullable|string',
            ]);

            $survey = Survey::create([
                'name' => $request->name,
                'settings' => [
                    'accept-guest-entries' => filter_var($request->settings['accept-guest-entries'], FILTER_VALIDATE_BOOLEAN),
                    'limit-per-participant' => (int) $request->settings['limit-per-participant'],
                ]
            ]);

            foreach ($request->sections as $sectionData) {
                $section = $survey->sections()->create(['name' => $sectionData['name']]);

                foreach ($sectionData['questions'] as $questionData) {
                    $section->questions()->create([
                        'content' => $questionData['content'],
                        'type' => $questionData['type'],
                        'rules' => isset($questionData['rules']) ? explode(',', $questionData['rules']) : [],
                        'options' => isset($questionData['options']) ? explode(',', $questionData['options']) : null,
                    ]);
                }
            }

            return redirect()->route('surveys.index')->with('success', 'Survey created successfully.');
        } catch (\Exception $e) {
            Log::error('Survey creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create survey. Please try again later.');
        }
    }

    public function view($id)
    {
        $survey = Survey::with('sections.questions')->findOrFail($id);
        $lastEntry = Entry::where('participant_id', auth()->id())->latest()->first();

        return view('surveys.view', compact('survey', 'lastEntry'));
    }

    public function edit(Survey $survey)
    {
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'settings.accept-guest-entries' => 'required',
                'settings.limit-per-participant' => 'required',
                'sections' => 'required|array',
                'sections.*.name' => 'required|string',
                'sections.*.questions' => 'required|array',
                'sections.*.questions.*.content' => 'required|string',
                'sections.*.questions.*.type' => 'required|string',
                'sections.*.questions.*.rules' => 'nullable|string',
            ]);

            // Update Survey
            $survey->update([
                'name' => $request->name,
                'settings' => [
                    'accept-guest-entries' => filter_var($request->settings['accept-guest-entries'], FILTER_VALIDATE_BOOLEAN),
                    'limit-per-participant' => (int) $request->settings['limit-per-participant'],
                ]
            ]);

            // Clear Existing Sections and Questions
            $survey->sections()->delete();

            // Recreate Sections and Questions
            foreach ($request->sections as $sectionData) {
                $section = $survey->sections()->create(['name' => $sectionData['name']]);

                foreach ($sectionData['questions'] as $questionData) {
                    $section->questions()->create([
                        'content' => $questionData['content'],
                        'type' => $questionData['type'],
                        'rules' => isset($questionData['rules']) ? explode(',', $questionData['rules']) : [],
                        'options' => isset($questionData['options']) ? explode(',', $questionData['options']) : null,
                    ]);
                }
            }

            return redirect()->route('surveys.index')->with('success', 'Survey updated successfully.');
        } catch (\Exception $e) {
            Log::error('Survey update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update survey. Please try again later.');
        }
    }
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('surveys.index')->with('success', 'Survey deleted successfully!');
    }

    public function createEntry(Survey $survey)
    {
        $lastEntry = null;
        return view('surveys.submit', compact('survey', 'lastEntry'));
    }
    public function submit(Survey $survey, Request $request)
    {
        // Validate the request data against the survey's rules
        $answers = $request->validate($survey->rules);

        // Create a new entry for the survey with the validated answers
        (new Entry)->for($survey)->by(auth()->user())->fromArray($answers)->push();

        // Redirect to a confirmation page or back to the survey list with a success message
        return redirect()->route('surveys.index')->with('success', 'Your responses have been submitted successfully.');
    }
}
