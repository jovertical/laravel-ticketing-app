<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        ]))->events;

        return Inertia::render('My/Events/Index', [
            'events' => $events,
        ]);
    }
}
