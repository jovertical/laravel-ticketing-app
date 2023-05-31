<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()
            ->with(['media', 'organizer'])
            ->whereNotIn('user_id', [Auth::user()->id])
            ->where('start_date', '>=', now()->format('Y-m-d'))
            ->orderBy('start_date')
            ->paginate(12)
            ->withQueryString()
            ->through(fn (Event $event) => array_merge($event->toArray(), [
                'banner' => $event->banner,
                'free' => $event->free,
                'is_upcoming' => $event->is_upcoming,
                'next_start_date' => $event->next_start_date,
            ]));

        return Inertia::render('Events/Index', [
            'events' => $events
        ]);
    }
}
