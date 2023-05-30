<?php

namespace App\Data;

use DateTime;
use Spatie\LaravelData\Data;

class EventData extends Data
{
    protected string $title;
    protected string $description;
    protected DateTime $startDate;
    protected DateTime $endDate;
    protected int $price;
    protected int $seats;
}
