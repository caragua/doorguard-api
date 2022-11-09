<?php

namespace Database\Factories;

use App\Models\AccessRule;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardReader>
 */
class AccessRuleFactory extends Factory
{
    protected $model = AccessRule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sites = Site::all()->toArray();

        return [
            'site_id'               => $sites[array_rand($sites, 1)]['id'],
            'description'           => $this->faker->sentence(3),
            'check_attendee_type'   => array_rand(config('codes.attendee.type'), 1),
            'check_age'             => array_rand(config('codes.access_rule.check_age'), 1),
            'single_pass'           => array_rand(config('codes.access_rule.single_pass'), 1)
        ];
    }
}
