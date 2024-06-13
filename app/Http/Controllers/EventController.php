<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'topic' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'deadline' => 'required|date',
            'users' => 'array|exists:users,id',
        ]);

        $event = Event::create($validatedData);
        if (isset($validatedData['users'])) {
            $event->users()->attach($validatedData['users']);
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
            'start' => 'required|date',
            'end' => 'required|date',
            'deadline' => 'required|date',
            'users' => 'array|exists:users,id',
        ]);

        $event->update($validatedData);
        if (isset($validatedData['users'])) {
            $event->users()->sync($validatedData['users']);
        }

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
