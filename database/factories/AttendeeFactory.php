<?php

namespace Database\Factories;

use App\Models\Attendee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardReader>
 */
class AttendeeFactory extends Factory
{
    protected $model = Attendee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $attendeeType = array_rand(config('codes.attendee.type'));

        return [
            'inscription_number'    => $attendeeType . $this->faker->numerify('###'),
            'type'                  => $attendeeType,
            'nickname'              => $this->faker->name(),
            'card_number'           => $this->faker->numerify('##########')
        ];
    }
}
