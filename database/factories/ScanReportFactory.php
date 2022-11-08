<?php

namespace Database\Factories;

use App\Models\ScanReport;
use App\Models\CardReader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardReader>
 */
class ScanReportFactory extends Factory
{
    protected $model = ScanReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cardReaders = CardReader::all()->toArray();

        return [
            'card_reader_id'    => $cardReaders[array_rand($cardReaders, 1)]['id'],
            'card_number'       => $this->faker->numberBetween(1000000, 10000000),
            'description'       => $this->faker->sentence(5),
            'pending'           => $this->faker->numberBetween(0,1)
        ];
    }
}
