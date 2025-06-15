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
            'date_time' => now()->addHours(rand(24, 120))->addMinutes(rand(0, 59))->seconds(0),
        ];
    }
}
