<?php

namespace Database\Factories;

use App\Models\Event;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new(),
            'title' => Str::title($this->faker->sentence($this->faker->numberBetween(3, 12))),
            'description' => $this->faker->paragraph(),

            'start_date' => ($startDate = $this->faker->dateTimeBetween('now', '+1 month'))->format('Y-m-d'),
            'start_time' => ($startTime = $startDate->setTime($this->faker->numberBetween(8, 20), 0, 0))
                ->format('H:i'),

            'end_date' => $this->faker->dateTimeBetween(
                $startDate,
                $startDate->format('Y-m-d') . ' +5 days'
            )->format('Y-m-d'),

            'end_time' => (new DateTime($startTime->format('H:i')))
                ->add(new DateInterval("PT{$this->faker->numberBetween(1, 3)}H"))
                ->format('H:i'),

            'price' => $this->faker->randomElement([0, $this->faker->numberBetween(1000, 10000)]),
            'seats' => $this->faker->numberBetween(10, 100),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Event $event) {
            $event->addMediaFromUrl("https://source.unsplash.com/random?{$event->id}&h=320&w=457")
                ->toMediaCollection('banners');
        });
    }
}
