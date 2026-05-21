<?php

namespace Database\Factories;

use App\Models\Events;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Events>
 */
class EventFactory extends Factory
{
    protected $model = Events::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 week', '+3 weeks');
        $end = (clone $start)->modify(sprintf('+%d hours', $this->faker->numberBetween(1, 5)));
        $registrationOpens = (clone $start)->modify(sprintf('-%d days', $this->faker->numberBetween(10, 20)));
        $registrationCloses = (clone $start)->modify(sprintf('-%d days', $this->faker->numberBetween(1, 5)));

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 0, 200),
            'stream_url' => $this->faker->optional()->url(),
            'registration_opens_at' => $registrationOpens,
            'registration_closes_at' => $registrationCloses,
            'event_starts_at' => $start,
            'event_ends_at' => $end,
            'max_participants' => $this->faker->optional()->numberBetween(20, 200),
            'status' => $this->faker->randomElement(['draft', 'published', 'active', 'finished', 'cancelled']),
        ];
    }
}
