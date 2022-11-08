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
        $levels     = Attendee::$codes['level'];
        $isminor    = Attendee::$codes['is_minor'];

        return [
            'inscription_number'    => $this->faker->bothify('?####'),
            'level'                 => array_rand($levels, 1),
            'nickname'              => $this->faker->name(),
            'is_minor'              => $this->faker->numberBetween(0,1),
            'card_number'           => $this->faker->numerify('########')
        ];
    }
}
