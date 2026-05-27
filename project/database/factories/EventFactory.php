<?php

namespace Database\Factories;

use App\Models\Events;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Events::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(0, 200),
            'stream_url' => $this->faker->url(),

            'registration_opens_at' => now(),
            'registration_closes_at' => now()->addDays(5),

            'event_starts_at' => now()->addDays(10),
            'event_ends_at' => now()->addDays(10)->addHours(2),

            'max_participants' => 100,

            'status' => 'published',
        ];
    }
}