<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduledVaccination>
 */
class ScheduledVaccinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'vaccine_center_id' => VaccineCenter::factory()->create()->id,
            'vaccine_date' => function (array $attributes) {
                $user = User::find($attributes['user_id']);
                $date = $user->created_at->addDay();

                while (!in_array($date->dayOfWeek, [0, 1, 2, 3, 4])) {
                    $date->addDay();
                }

                $hour = $this->faker->numberBetween(10, 17);
                $minute = $this->faker->numberBetween(0, 59);
                $second = $this->faker->numberBetween(0, 59);

                return $date->setTime($hour, $minute, $second)->toDateTimeString();
            },
            'status' => 3,
        ];
    }
}
