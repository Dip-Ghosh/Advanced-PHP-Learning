<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => 'Yoga', 'minutes' => [50, 60]],
            ['name' => 'Dance Fitness', 'minutes' => [40, 50]],
            ['name' => 'Pilates', 'minutes' => [55, 65]],
            ['name' => 'Boxing', 'minutes' => [45, 55]],
        ];

        foreach ($classes as $class) {
            ClassType::create([
                'name' => $class['name'],
                'description' => fake()->paragraph(),
                'minutes' => fake()->numberBetween($class['minutes'][0], $class['minutes'][1]),
            ]);
        }
    }
}
