<?php

namespace Database\Factories;

use App\Models\CardReader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardReader>
 */
class CardReaderFactory extends Factory
{
    protected $model = CardReader::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mac_address'   => $this->faker->macAddress(),
            'nickname'      => $this->faker->userName(),
            'function'      => $this->faker->numberBetween(0,3),
            'data'          => ''
        ];
    }
}
