<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('users')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $users = User::all();
        return view('events.create', compact('users'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $users = User::all();
        $eventUsers = $event->users->pluck('id')->toArray();
        return view('events.edit', compact('event', 'users', 'eventUsers'));
    }


    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'topic' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'deadline' => 'required|date',
            'users' => 'array|exists:users,id',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        // Handle file upload
        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        // Create and save the event
        $event = new Event();
        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];
        $event->topic = $validatedData['topic'];
        $event->location = $validatedData['location'];
        $event->start = $validatedData['start'];
        $event->end = $validatedData['end'];
        $event->deadline = $validatedData['deadline'];
        $event->img = $imageName;

        // Save the event and log its ID
        $event->save();
        Log::info('Event created with ID: ' . $event->id);

        // Attach users to the event
        if (!empty($validatedData['users'])) {
            foreach ($validatedData['users'] as $userId) {
                $event->users()->attach($userId);
                Log::info('User ' . $userId . ' attached to event.');
            }
        } else {
            Log::info('No users attached to event.');
        }


        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'topic' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'start' => 'required|date',
            'end' => 'required|date',
            'deadline' => 'required|date',
            'users' => 'array|exists:users,id',
        ]);

        // Update the event with validated data
        $event->update($validatedData);

        // Handle image update if provided
        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($event->img && file_exists(public_path('images/' . $event->img))) {
                unlink(public_path('images/' . $event->img));
            }

            // Move and save new image
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $event->img = $imageName;
        }

        // Sync users associated with the event
        if (isset($validatedData['users'])) {
            $event->users()->sync($validatedData['users']);
        }

        // Save the updated event
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function view($id)
    {
        $event = Event::findOrFail($id);
        $users = User::all();
        $eventUsers = $event->users->pluck('id')->toArray();
        return view('events.view', compact('event', 'users', 'eventUsers'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
