<?php

namespace Database\Factories;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),

            'start_date' => ($startDate = $this->faker->dateTimeBetween('now', '+1 month'))->format('Y-m-d'),
            'start_time' => ($startTime = $startDate->setTime($this->faker->numberBetween(8, 20), 0, 0))
                ->format('H:i'),

            'end_date' => ($endDate = $this->faker->dateTimeBetween(
                $startDate,
                $startDate->format('Y-m-d') . ' +5 days'
            ))->format('Y-m-d'),

            'end_time' => ($endTime = (new DateTime($startTime->format('H:i'))))
                ->add(new DateInterval("PT{$this->faker->numberBetween(1, 3)}H"))
                ->format('H:i'),

            'times' => collect(
                new DatePeriod(
                    new DateTime($startDate->format('Y-m-d') . ' ' . $startTime->format('H:i')),
                    new DateInterval('P1D'),
                    new DateTime($endDate->format('Y-m-d') . ' ' . $endTime->format('H:i'))
                )
            )->map(fn (DateTime $date) => [
                'from' => new DateTime($date->format('Y-m-d') . ' ' . $startTime->format('H:i')),
                'to' => new DateTime($date->format('Y-m-d') . ' ' . $endTime->format('H:i')),
            ])->toArray(),

            'price' => $this->faker->numberBetween(1000, 10000),
            'seats' => $this->faker->numberBetween(10, 100),
        ];
    }
}
