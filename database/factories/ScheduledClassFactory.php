<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduledClassFactory extends Factory
{
    public function definition(): array
    {
        return [
            'instructor_id' => rand(15, 24),
            'class_type_id' => rand(1, 4),
            'date_time' => Carbon::now()->addHours(rand(24, 120))->minutes(0)->seconds(0),
        ];
    }
}
