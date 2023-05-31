<?php

namespace App\Observers;

use App\Models\Event;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        $event->update([
            'times' => collect(
                new DatePeriod(
                    new DateTime($event->start_date . ' ' . $event->start_time),
                    new DateInterval('P1D'),
                    new DateTime($event->end_date . ' ' . $event->end_time)
                )
            )->map(fn (DateTime $date) => [
                'from' => Carbon::parse(new DateTime($date->format('Y-m-d') . ' ' . $event->start_time)),
                'to' => Carbon::parse(new DateTime($date->format('Y-m-d') . ' ' . $event->end_time)),
            ])->toArray()
        ]);
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
