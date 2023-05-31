<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'times' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'price',
        'seats',
        'times',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getIsUpcomingAttribute(): bool
    {
        return Carbon::parse($this->start_date . ' ' . $this->start_time)->isFuture();
    }

    /**
     * If the event is upcoming, return the start date.
     * Otherwise, return the start date based on the current time.
     */
    public function getNextStartDateAttribute(): ?string
    {
        if (!$this->is_upcoming) {
            return collect($this->times)
                ->firstWhere('from', '>=', now())['from'] ?? null;
        }

        return Arr::get($this->times, '0.from');
    }

    public function getFreeAttribute(): bool
    {
        return $this->price === 0;
    }

    public function getBannerAttribute(): string
    {
        return $this->getFirstMediaUrl('banners');
    }
}
