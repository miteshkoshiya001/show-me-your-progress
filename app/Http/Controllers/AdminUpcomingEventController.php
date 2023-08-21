<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UpcomingEvent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminUpcomingEventController extends Controller
{
    public function index()
    {
        $upcomingEvents = UpcomingEvent::all();

        return view('admin.upcoming-events', compact('upcomingEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::today(), // Ensure event date is today or later
            ],
            'location' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('event_images', 'public');

        $upcomingEvent = new UpcomingEvent([
            'title' => $request->get('title'),
            'image' => $imagePath,
            'event_date' => $request->get('event_date'),
            'location' => $request->get('location'),
        ]);
        $upcomingEvent->save();

        return redirect()->route('upcoming_events.index')->with('success', 'Event added successfully');
    }

    public function edit($id)
    {
        $event = UpcomingEvent::findOrFail($id);
        return view('admin.upcoming_events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::today(),
            ],
            'location' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
        ]);

        $event = UpcomingEvent::findOrFail($id);
        $event->title = $request->title;
        $event->event_date = $request->event_date;
        $event->location = $request->location;

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            // Upload and store the new image
            $imagePath = $request->file('image')->store('event_images', 'public');
            $event->image = $imagePath;
        }

        $event->save();

        return redirect()->route('upcoming_events.index')
            ->with('success', 'Event updated successfully.');
    }


    public function destroy($id)
    {
        $event = UpcomingEvent::findOrFail($id);
        $event->delete();

        return redirect()->route('upcoming_events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
