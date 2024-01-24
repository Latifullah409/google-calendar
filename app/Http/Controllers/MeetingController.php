<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Services\GoogleCalendarService;
class MeetingController extends Controller
{

    public function index()
    {
        // Logic for meeting listing with pagination
        $meetings = Meeting::with(['creator', 'attendees'])->paginate(10);

        return view('meetings.index', compact('meetings'));
    }

    public function create(){
        // Assuming $users contains a collection of users
        $users = User::take(2)->get();

        return view('meetings.create', compact('users'));
    }

    public function store(Request $request, GoogleCalendarService $googleCalendarService)
    {
        $request->validate([
            'subject' => 'required|string',
            'date_time' => 'required|date',
            'attendees' => 'required|array|size:2',
        ]);

        // Create the meeting
        $meeting = Meeting::create([
            'subject' => $request->input('subject'),
            'date_time' => $request->input('date_time'),
            'creator_id' => auth()->user()->id,
        ]);

        // Attach attendees to the meeting
        $attendees = $request->input('attendees');
        $meeting->attendees()->attach($attendees);

        // Create event in Google Calendar
        $eventData = [
            'subject' => $meeting->subject,
            'description' => $meeting->description,
            'date_time' => optional($meeting->date_time)->format('c'), // ISO 8601 format
            'end_time' => optional($meeting->end_time)->format('c'), // ISO 8601 format
        ];

        $googleCalendarService->createEvent($eventData);

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully');
    }
    
    public function edit(Meeting $meeting)
    {
        // Assuming you have a view file named 'edit.blade.php'
        return view('meetings.edit', compact('meeting'));
    }

    public function update($id, GoogleCalendarService $googleCalendarService)
    {
        // Logic for meeting update
        $meeting = Meeting::findOrFail($id);

        $meeting->update([
            'subject' => request('subject'),
            'date_time' => request('date_time'),
        ]);

        // Update event in Google Calendar
        $eventData = [
            'subject' => $meeting->subject,
            'description' => $meeting->description,
            'date_time' => optional($meeting->date_time)->format('c'), // ISO 8601 format
            'end_time' => optional($meeting->end_time)->format('c'), // ISO 8601 format
        ];

        $googleCalendarService->updateEvent($meeting->google_event_id, $eventData);


        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully');
    }

    public function destroy($id, GoogleCalendarService $googleCalendarService)
    {
        // Logic for meeting deletion
        $meeting = Meeting::findOrFail($id);

        // Delete event in Google Calendar
        $googleCalendarService->deleteEvent($meeting->google_event_id);

        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully');
    }

}
