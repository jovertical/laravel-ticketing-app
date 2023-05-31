<?php

namespace App\Http\Requests;

use App\Data\EventData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class StoreEventRequest extends FormRequest
{
    use WithData;

    protected function dataClass(): string
    {
        return EventData::class;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
