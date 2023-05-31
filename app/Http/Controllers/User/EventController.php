<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    /**
     * Display the user's event listing
     */
    public function index(Request $request): Response
    {
        $events = ($request->user()->load([
            'events' => fn ($query) => $query->orderBy('start_date', 'desc'),
            'events.media' => fn ($query) => $query->where('collection_name', 'banners'),
        ]))->events->transform(fn ($event) => array_merge($event->toArray(), [
            'banner' => $event->getFirstMediaUrl('banners'),
        ]));

        return Inertia::render('User/Events/Index', [
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new event
     */
    public function create(): Response
    {
        return Inertia::render('User/Events/Create');
    }

    /**
     * Store a newly created event in storage
     */
    public function store(StoreEventRequest $request)
    {
        /** @var \App\Models\Event $event */
        $event = $request->user()
            ->events()
            ->create(Arr::except($request->getData()->toArray(), ['banner']));

        if ($request->hasFile('banner')) {
            $event->addMediaFromRequest('banner')
                ->toMediaCollection('banners');
        }

        return Redirect::route('user.events.index')->with('notification', [
            'type' => 'success',
            'title' => 'Event created successfully',
            'message' => 'The event is ready for bookings',
        ]);
    }
}
