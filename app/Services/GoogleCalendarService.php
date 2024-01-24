<?php

namespace App\Services;

use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarService
{
    protected $googleCalendar;

    public function __construct()
    {

    }

    public function createEvent($eventData)
    {
        $event = new Event;
        $event->name = $eventData['subject'];
        $event->startDateTime = Carbon::parse($eventData['date_time']);
        $event->endDateTime = Carbon::parse($eventData['end_time']);
        $event->save();
    }

    public function updateEvent($eventId, $eventData)
    {
        $event = Event::find($eventId);

        if ($event) {
            $event->name = $eventData['subject'];
            $event->startDateTime = Carbon::parse($eventData['date_time']);
            $event->endDateTime = Carbon::parse($eventData['end_time']);
            $event->save();
            
            return true; // Indicate success
        }

        return false; // Indicate failure (event not found)
    }


    public function deleteEvent($eventId)
    {
        $event = Event::find($eventId);

        $event->delete();
    }
}
