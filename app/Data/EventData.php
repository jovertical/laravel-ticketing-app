<?php

namespace App\Data;

use DateTime;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class EventData extends Data
{
    public string $title;
    public ?string $description;
    public ?UploadedFile $banner;

    #[WithCast(DateTimeInterfaceCast::class, format: 'M d, Y')]
    public DateTime $startDate;
    public string $startTime;

    #[WithCast(DateTimeInterfaceCast::class, format: 'M d, Y')]
    public DateTime $endDate;
    public string $endTime;

    public float $price;
    public int $seats;

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'banner' => $this->banner,
            'start_date' => $this->startDate->format('Y-m-d'),
            'start_time' => $this->startTime,
            'end_date' => $this->endDate->format('Y-m-d'),
            'end_time' => $this->endTime,
            'price' => (int)($this->price * 100),
            'seats' => $this->seats,
        ];
    }
}
